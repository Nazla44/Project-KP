<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $kader = $request->user()->kader;

        $events = Event::query()
            ->where('kader_id', $kader->id)
            ->latest('tanggal_pelaksanaan')
            ->paginate((int) $request->query('per_page', 15));

        return response()->json(['message' => 'Daftar event berhasil diambil.', 'data' => $events]);
    }

    public function store(Request $request): JsonResponse
    {
        $kader = $request->user()->kader;

        $validated = $request->validate([
            'judul' => ['required','string','max:150'],
            'tanggal_pelaksanaan' => ['required','date','after_or_equal:today'],
            'lokasi_alamat' => ['required','string','max:1000'],
            'lokasi_lat' => ['nullable','numeric','between:-90,90'],
            'lokasi_lng' => ['nullable','numeric','between:-180,180'],
            'deskripsi' => ['nullable','string','max:2000'],
            'submit' => ['nullable','boolean'],
        ]);

        $status = filter_var($request->input('submit', true), FILTER_VALIDATE_BOOLEAN)
            ? Event::STATUS_MENUNGGU
            : Event::STATUS_DRAFT;

        $event = Event::query()->create(array_merge($validated, [
            'kader_id' => $kader->id,
            'status' => $status,
            'submitted_at' => $status === Event::STATUS_MENUNGGU ? now() : null,
        ]));

        return response()->json(['message' => 'Event berhasil dibuat.', 'data' => $event], 201);
    }

    public function show(Request $request, Event $event): JsonResponse
    {
        abort_unless($event->kader_id === $request->user()->kader->id, 403);

        return response()->json(['message' => 'Detail event berhasil diambil.', 'data' => $event->load('reportA')]);
    }

    public function update(Request $request, Event $event): JsonResponse
    {
        abort_unless($event->kader_id === $request->user()->kader->id, 403);
        abort_if(in_array($event->status, [Event::STATUS_DISETUJUI, Event::STATUS_SELESAI], true), 422, 'Event yang sudah disetujui/selesai tidak dapat diedit.');

        $validated = $request->validate([
            'judul' => ['sometimes','required','string','max:150'],
            'tanggal_pelaksanaan' => ['sometimes','required','date','after_or_equal:today'],
            'lokasi_alamat' => ['sometimes','required','string','max:1000'],
            'lokasi_lat' => ['nullable','numeric','between:-90,90'],
            'lokasi_lng' => ['nullable','numeric','between:-180,180'],
            'deskripsi' => ['nullable','string','max:2000'],
            'status' => ['nullable', Rule::in([Event::STATUS_DRAFT, Event::STATUS_MENUNGGU, Event::STATUS_BATAL])],
        ]);

        if (($validated['status'] ?? null) === Event::STATUS_MENUNGGU && $event->status !== Event::STATUS_MENUNGGU) {
            $validated['submitted_at'] = now();
        }
        if (($validated['status'] ?? null) === Event::STATUS_BATAL) {
            $validated['cancelled_at'] = now();
        }

        $event->update($validated);

        return response()->json(['message' => 'Event berhasil diperbarui.', 'data' => $event->fresh()]);
    }
}
