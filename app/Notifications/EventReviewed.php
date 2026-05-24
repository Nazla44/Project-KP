<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventReviewed extends Notification
{
    use Queueable;

    public function __construct(private readonly Event $event)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $approved = $this->event->status === Event::STATUS_DISETUJUI;

        return (new MailMessage)
            ->subject($approved ? 'Event Sosialisasi Disetujui' : 'Event Sosialisasi Ditolak')
            ->greeting('Halo '.$this->event->kader->nama.',')
            ->line('Judul event: '.$this->event->judul)
            ->line($approved ? 'Event Anda telah disetujui dan dapat dilaksanakan sesuai jadwal.' : 'Event Anda belum dapat disetujui.')
            ->line('Catatan admin: '.($this->event->catatan_admin ?: '-'));
    }
}
