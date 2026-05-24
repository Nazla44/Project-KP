<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\ReportA;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportAController extends Controller
{
    public function store(Request $request, Event $event): JsonResponse
    {
        $kader = $request->user()->kader;
        abort_unless($event->kader_id === $kader->id, 403);
        abort_unless($event->status === Event::STATUS_DISETUJUI, 422, 'Report A hanya bisa dibuat untuk event yang disetujui.');

        $validated = $request->validate([
            'jumlah_peserta' => ['required','integer','min:0'],
            'topik' => ['nullable','string','max:2000'],
            'catatan' => ['nullable','string','max:2000'],
            'foto_urls' => ['nullable','array'],
            'foto_urls.*' => ['url','max:500'],
            'status' => ['nullable','in:selesai,dibatalkan'],
        ]);

        $report = ReportA::query()->updateOrCreate(
            ['event_id' => $event->id],
            array_merge($validated, ['kader_id' => $kader->id, 'dibuat_pada' => now()])
        );

        if (($validated['status'] ?? 'selesai') === 'selesai') {
            $event->update(['status' => Event::STATUS_SELESAI]);
        }

        return response()->json(['message' => 'Report A berhasil disimpan.', 'data' => $report], 201);
    }
}
