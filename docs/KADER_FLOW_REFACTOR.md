# Kader Flow Refactor

Perubahan utama:

1. Flow pendaftaran kader dipusatkan di `KaderRegistrationController`.
2. Data pendaftaran publik masuk ke tabel `kaders` dengan status `verifikasi`.
3. Admin melihat daftar di `/admin/kaders`.
4. Admin membuka detail `/admin/kaders/{kader}` untuk approve atau reject.
5. Approve membuat user role `kader`, membuat token reset password, lalu mengirim email set password.
6. Reject menyimpan `rejection_reason` dan mengirim email penolakan.
7. Tampilan `/admin/kaders` diselaraskan dengan gaya admin Users/Klinik: page header, filter pill, search box, DataTables, card/table styling.
8. File lama yang tidak dipakai dan bentrok dihapus:
   - `app/Http/Controllers/Admin/KaderApprovalController.php`
   - `app/Http/Controllers/AdminAuthController.php`
   - `app/Http/Controllers/AdminDashboardController.php`
   - `app/Notifications/KaderApplicationReviewed.php`
   - migration rebuild/update kader yang duplikatif.

Status yang dipakai di database:

- `verifikasi`: pendaftaran baru/menunggu review admin
- `aktif`: sudah approved dan sudah dibuatkan user
- `ditolak`: ditolak admin dengan alasan
- `suspend`: status cadangan untuk nonaktif sementara
