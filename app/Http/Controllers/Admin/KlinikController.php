<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommitKlinikImportRequest;
use App\Http\Requests\Admin\PreviewKlinikImportRequest;
use App\Http\Requests\Admin\StoreKlinikRequest;
use App\Http\Requests\Admin\UpdateKlinikRequest;
use App\Models\Klinik;
use App\Models\KlinikImport;
use App\Services\KlinikImportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class KlinikController extends Controller
{
    public function __construct(private readonly KlinikImportService $importService)
    {
    }

    public function index(): View
    {
        return view('admin.kliniks.index', [
            'pageTitle' => 'Kelola Klinik',
            'kliniks' => Klinik::query()->orderBy('nama')->get(),
            'recentImports' => Schema::hasTable('klinik_imports')
                ? KlinikImport::query()->with('user')->latest()->take(10)->get()
                : collect(),
        ]);
    }

    public function show(Klinik $klinik): JsonResponse
    {
        return response()->json(['data' => $klinik]);
    }

    public function store(StoreKlinikRequest $request): RedirectResponse
    {
        Klinik::query()->create($this->mapKlinikPayload($request->validated()));

        return redirect()->route('admin.kliniks.index')->with('status', 'Klinik berhasil dibuat.');
    }

    public function update(UpdateKlinikRequest $request, Klinik $klinik): RedirectResponse
    {
        $klinik->update($this->mapKlinikPayload($request->validated()));

        return redirect()->route('admin.kliniks.index')->with('status', 'Data klinik berhasil diperbarui.');
    }

    public function destroy(Klinik $klinik): RedirectResponse
    {
        if ($klinik->kaders()->exists()) {
            return redirect()->route('admin.kliniks.index')
                ->withErrors(['destroy' => 'Klinik yang sudah dipakai kader tidak dapat dihapus. Gunakan status nonaktif jika diperlukan.']);
        }

        $klinik->delete();

        return redirect()->route('admin.kliniks.index')->with('status', 'Klinik berhasil dihapus.');
    }

    public function previewImport(PreviewKlinikImportRequest $request): RedirectResponse|JsonResponse
    {
        $import = $this->importService->preview($request->file('file'), $request->user());

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Preview import berhasil dibuat.',
                'import_id' => $import->id,
                'status' => $import->status,
                'data' => $import->preview_payload,
            ]);
        }

        return redirect()->route('admin.kliniks.index')
            ->with('status', 'Preview import berhasil dibuat.')
            ->with('import_preview', array_merge($import->preview_payload ?? [], [
                'import_id' => $import->id,
                'status' => $import->status,
                'filename' => $import->original_filename,
            ]));
    }

    public function commitImport(CommitKlinikImportRequest $request): RedirectResponse|JsonResponse
    {
        $import = KlinikImport::query()->findOrFail($request->integer('import_id'));

        try {
            $summary = $this->importService->commit($import);
        } catch (ValidationException $exception) {
            if ($request->expectsJson()) {
                throw $exception;
            }

            return redirect()->route('admin.kliniks.index')
                ->withErrors($exception->errors())
                ->with('import_preview', array_merge($import->preview_payload ?? [], [
                    'import_id' => $import->id,
                    'status' => $import->status,
                    'filename' => $import->original_filename,
                ]));
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Import klinik berhasil dijalankan.',
                'import_id' => $import->id,
                'data' => $summary,
            ]);
        }

        return redirect()->route('admin.kliniks.index')->with('status', 'Import klinik berhasil dijalankan.');
    }

    public function importHistory(Request $request): JsonResponse
    {
        if (!Schema::hasTable('klinik_imports')) {
            return response()->json([
                'data' => [],
                'message' => 'Tabel import klinik belum tersedia. Jalankan migration terlebih dahulu.',
            ]);
        }

        return response()->json(
            KlinikImport::query()
                ->with('user')
                ->latest()
                ->paginate((int) $request->query('per_page', 15))
        );
    }

    private function mapKlinikPayload(array $validated): array
    {
        return [
            'kode_klinik' => blank($validated['kode_klinik'] ?? null) ? null : $validated['kode_klinik'],
            'nama' => $validated['nama'],
            'tipe' => $validated['tipe'],
            'alamat' => $validated['alamat'],
            'kota' => $validated['kota'],
            'provinsi' => $validated['provinsi'],
            'telepon' => blank($validated['telepon'] ?? null) ? null : $validated['telepon'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'jam_buka' => blank($validated['jam_buka'] ?? null) ? null : $validated['jam_buka'],
            'jam_tutup' => blank($validated['jam_tutup'] ?? null) ? null : $validated['jam_tutup'],
            'hari_buka' => blank($validated['hari_buka'] ?? null) ? null : $validated['hari_buka'],
            'hari_tutup' => blank($validated['hari_tutup'] ?? null) ? null : $validated['hari_tutup'],
            'layanan' => $this->parseServices($validated['layanan'] ?? ''),
            'status' => $validated['status'],
        ];
    }

    private function parseServices(string $value): array
    {
        if (trim($value) === '') {
            return [];
        }

        $segments = preg_split('/[\r\n,|;]/', $value) ?: [];

        return array_values(array_filter(array_map(fn ($item) => trim((string) $item), $segments)));
    }
}
