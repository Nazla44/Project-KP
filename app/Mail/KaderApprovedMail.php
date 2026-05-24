<?php

namespace App\Mail;

use App\Models\Kader;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KaderApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Kader $kader,
        public User $user,
        public string $token
    ) {
    }

    public function build(): self
    {
        $setPasswordUrl = route('kader.password.edit', [
            'token' => $this->token,
            'email' => $this->user->email,
        ]);

        return $this
            ->subject('Pendaftaran Kader Disetujui')
            ->view('emails.kader-approved')
            ->with([
                'kader' => $this->kader,
                'user' => $this->user,
                'setPasswordUrl' => $setPasswordUrl,
            ]);
    }
}