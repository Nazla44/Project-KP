<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Pendaftaran Kader Belum Dapat Disetujui</title>
</head>

<body style="font-family: Arial, sans-serif; color: #1f2937; line-height: 1.6;">
    <h2 style="color: #c31513;">Pendaftaran Kader Belum Dapat Disetujui</h2>

    <p>Halo <strong><?php echo e($kader->nama); ?></strong>,</p>

    <p>
        Terima kasih sudah mendaftar sebagai kader komunitas TBC.
        Setelah proses verifikasi, pendaftaran Anda saat ini belum dapat kami setujui.
    </p>

    <p>
        <strong>Alasan:</strong>
    </p>

    <blockquote style="border-left: 4px solid #c31513; padding-left: 12px; color: #4b5563;">
        <?php echo e($kader->rejection_reason); ?>

    </blockquote>

    <p>
        Anda dapat menghubungi tim STPI jika membutuhkan informasi lebih lanjut.
    </p>

    <p>
        Terima kasih,<br>
        Stop TB Partnership Indonesia
    </p>
</body>

</html>
<?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP\resources\views/emails/kader-rejected.blade.php ENDPATH**/ ?>