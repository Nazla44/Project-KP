<?php

namespace App\Mail;

use App\Models\Kader;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KaderRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Kader $kader
    ) {
    }

    public function build(): self
    {
        return $this
            ->subject('Pendaftaran Kader Belum Dapat Disetujui')
            ->view('emails.kader-rejected')
            ->with([
                'kader' => $this->kader,
            ]);
    }
}