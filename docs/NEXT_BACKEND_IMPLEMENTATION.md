# Stop TB Platform — Backend Next Step Implementation

## Fokus patch ini
Patch ini mengubah project Laravel menjadi backend MVP untuk alur dokumen Platform Stop TB Indonesia:

1. Pendaftaran kader tersimpan ke database, bukan hanya session.
2. Admin dapat approve/tolak/suspend kader dan mengirim email notifikasi.
3. User kader dibuat otomatis saat kader disetujui.
4. API mobile kader memakai Sanctum token.
5. Kader dapat membuat event, submit approval, dan membuat Report A.
6. Kader dapat membuka sesi pemeriksaan terkait event atau sesi mandiri.
7. Kader dapat input warga + jawaban gejala, sistem menghitung skor TBC otomatis.
8. Report B tersimpan lewat `screening_sessions` dan `screening_results`.
9. Konfigurasi scoring disimpan di database via `scoring_rules`.

## Instalasi setelah copy patch

```bash
composer require laravel/sanctum
composer install
php artisan migrate
php artisan db:seed --class=ScoringRuleSeeder
php artisan route:list
```

Untuk email lokal:

```env
MAIL_MAILER=log
```

atau gunakan SMTP sungguhan untuk production.

## Endpoint utama

### Auth
`POST /api/auth/login`

```json
{
  "login": "kader@example.com",
  "password": "password",
  "device_name": "android"
}
```

Gunakan token sebagai `Authorization: Bearer <token>`.

### Event kader
- `GET /api/events`
- `POST /api/events`
- `GET /api/events/{event}`
- `PUT/PATCH /api/events/{event}`
- `POST /api/events/{event}/report-a`

Payload create event:

```json
{
  "judul": "Sosialisasi TBC RW 03",
  "tanggal_pelaksanaan": "2026-06-10",
  "lokasi_alamat": "Balai Warga RW 03",
  "lokasi_lat": -6.2,
  "lokasi_lng": 106.8,
  "deskripsi": "Edukasi dan skrining awal",
  "submit": true
}
```

### Sesi skrining
- `GET /api/screening-sessions`
- `POST /api/screening-sessions`
- `GET /api/screening-sessions/{screeningSession}`
- `POST /api/screening-sessions/{screeningSession}/results`
- `POST /api/screening-sessions/{screeningSession}/close`

Payload hasil skrining:

```json
{
  "warga": {
    "nik": "3173010101010001",
    "nama_lengkap": "Budi Santoso",
    "alamat": "Jl. Melati No. 1",
    "tanggal_lahir": "1988-01-01",
    "jenis_kelamin": "L",
    "consent_verbal": true
  },
  "jawaban_gejala": {
    "batuk_2_minggu": true,
    "demam_2_minggu": false,
    "keringat_malam": true,
    "bb_turun": false,
    "batuk_darah": false,
    "kontak_serumah": true,
    "dm_hiv": false,
    "merokok_aktif": true,
    "lingkungan_padat": true
  },
  "klinik_id": 1,
  "catatan_kader": "Disarankan ke faskes terdekat."
}
```

## Catatan teknis penting
- Patch ini memakai `Kader.user_id` agar akun login hanya dibuat setelah approval admin.
- Password awal user kader saat approval masih dibuat random. Untuk production, lanjutkan dengan fitur set password / reset password via email.
- `ScoringRuleSeeder` memindahkan bobot scoring ke database agar bisa dibuat UI konfigurasi di admin panel.
- NIK warga masih plaintext. Untuk production, tambahkan field hash/tokenisasi dan pembatasan akses sesuai UU PDP.
