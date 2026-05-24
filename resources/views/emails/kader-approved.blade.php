<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Pendaftaran Kader Disetujui</title>
</head>

<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6;">
    <h2 style="color: #c31513;">Pendaftaran Kader Disetujui</h2>

    <p>Halo <strong>{{ $kader->nama }}</strong>,</p>

    <p>
        Selamat! Pendaftaran Anda sebagai kader komunitas TBC telah disetujui.
        Akun Anda sudah dibuat dengan email:
    </p>

    <p>
        <strong>{{ $user->email }}</strong>
    </p>

    <p>
        Untuk mulai menggunakan akun, silakan buat password terlebih dahulu melalui tombol berikut:
    </p>

    <p style="margin: 24px 0;">
        <a href="{{ $setPasswordUrl }}"
            style="background: #c31513; color: #ffffff; padding: 12px 18px; text-decoration: none; border-radius: 8px; display: inline-block;">
            Buat Password
        </a>
    </p>

    <p>
        Jika tombol tidak dapat dibuka, salin tautan berikut ke browser:
    </p>

    <p style="word-break: break-all;">
        {{ $setPasswordUrl }}
    </p>

    <p>
        Abaikan email ini jika Anda merasa tidak pernah mendaftar sebagai kader.
    </p>

    <p>
        Terima kasih,<br>
        Stop TB Partnership Indonesia
    </p>
</body>

</html>
