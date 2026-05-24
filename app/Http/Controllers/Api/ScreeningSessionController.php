<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\ScreeningSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScreeningSessionController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $sessions = ScreeningSession::query()
            ->where('kader_id', $request->user()->kader->id)
            ->with('event:id,judul,tanggal_pelaksanaan')
            ->latest('tanggal_sesi')
            ->paginate((int) $request->query('per_page', 15));

        return response()->json(['message' => 'Daftar sesi berhasil diambil.', 'data' => $sessions]);
    }

    public function store(Request $request): JsonResponse
    {
        $kader = $request->user()->kader;
        $validated = $request->validate([
            'event_id' => ['nullable','exists:events,id'],
            'tanggal_sesi' => ['required','date'],
            'lokasi_alamat' => ['required','string','max:1000'],
            'lokasi_lat' => ['nullable','numeric','between:-90,90'],
            'lokasi_lng' => ['nullable','numeric','between:-180,180'],
        ]);

        if (! empty($validated['event_id'])) {
            $event = Event::query()->findOrFail($validated['event_id']);
            abort_unless($event->kader_id === $kader->id && $event->status === Event::STATUS_DISETUJUI, 422, 'Event tidak valid untuk sesi pemeriksaan.');
        }

        $session = ScreeningSession::query()->create(array_merge($validated, [
            'kader_id' => $kader->id,
            'status' => ScreeningSession::STATUS_AKTIF,
        ]));

        return response()->json(['message' => 'Sesi pemeriksaan berhasil dibuat.', 'data' => $session], 201);
    }

    public function show(Request $request, ScreeningSession $screeningSession): JsonResponse
    {
        abort_unless($screeningSession->kader_id === $request->user()->kader->id, 403);

        return response()->json([
            'message' => 'Detail sesi berhasil diambil.',
            'data' => $screeningSession->load(['event', 'results.warga', 'results.klinik']),
        ]);
    }

    public function close(Request $request, ScreeningSession $screeningSession): JsonResponse
    {
        abort_unless($screeningSession->kader_id === $request->user()->kader->id, 403);

        $screeningSession->update(['status' => ScreeningSession::STATUS_SELESAI, 'closed_at' => now()]);

        return response()->json(['message' => 'Sesi pemeriksaan berhasil ditutup.', 'data' => $screeningSession->fresh()]);
    }
}
