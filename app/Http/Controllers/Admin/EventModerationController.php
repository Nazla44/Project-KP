<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Notifications\EventReviewed;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EventModerationController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.events.index', [
            'pageTitle' => 'Moderasi Event',
            'events' => Event::query()
                ->with('kader')
                ->when($request->query('status'), fn ($q, $status) => $q->where('status', $status))
                ->latest('submitted_at')
                ->paginate(20),
        ]);
    }

    public function review(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in([Event::STATUS_DISETUJUI, Event::STATUS_DITOLAK])],
            'catatan_admin' => ['nullable','string','max:1000'],
        ]);

        $event->update([
            'status' => $validated['status'],
            'catatan_admin' => $validated['catatan_admin'] ?? null,
            'approved_by' => $request->user()->id,
            'approved_at' => now(),
        ]);

        Notification::route('mail', $event->kader->email)->notify(new EventReviewed($event->fresh('kader')));

        return back()->with('status', 'Status event berhasil diperbarui dan email notifikasi dikirim.');
    }
}
