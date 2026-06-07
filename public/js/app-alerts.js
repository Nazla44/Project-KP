document.addEventListener("DOMContentLoaded", function () {
    /*
    |--------------------------------------------------------------------------
    | FLASH NOTIFICATION FROM LARAVEL SESSION
    |--------------------------------------------------------------------------
    */

    if (window.AppFlash) {
        const flash = window.AppFlash;

        if (flash.success) {
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: flash.success,
                confirmButtonColor: "#e3000b",
            });
        }

        if (flash.error) {
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: flash.error,
                confirmButtonColor: "#e3000b",
            });
        }

        if (flash.warning) {
            Swal.fire({
                icon: "warning",
                title: "Perhatian",
                text: flash.warning,
                confirmButtonColor: "#e3000b",
            });
        }

        if (flash.info) {
            Swal.fire({
                icon: "info",
                title: "Informasi",
                text: flash.info,
                confirmButtonColor: "#e3000b",
            });
        }

        if (flash.validationErrors && flash.validationErrors.length > 0) {
            Swal.fire({
                icon: "error",
                title: "Data belum valid",
                html: `
                    <div style="text-align:left">
                        <ul style="margin:0; padding-left:18px">
                            ${flash.validationErrors.map(error => `<li>${error}</li>`).join("")}
                        </ul>
                    </div>
                `,
                confirmButtonColor: "#e3000b",
            });
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CONFIRM SUBMIT FORM
    |--------------------------------------------------------------------------
    | Pakai class: js-confirm-submit
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll("form.js-confirm-submit").forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            const title = form.dataset.title || "Simpan data?";
            const text = form.dataset.text || "Pastikan data yang diisi sudah benar.";
            const confirmText = form.dataset.confirm || "Ya, simpan";
            const icon = form.dataset.icon || "question";

            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: "#e3000b",
                cancelButtonColor: "#6b7280",
                confirmButtonText: confirmText,
                cancelButtonText: "Batal",
                reverseButtons: true,
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.classList.remove("js-confirm-submit");
                    form.submit();
                }
            });
        });
    });

    /*
    |--------------------------------------------------------------------------
    | CONFIRM DELETE
    |--------------------------------------------------------------------------
    | Pakai class: js-confirm-delete
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll("form.js-confirm-delete").forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            const title = form.dataset.title || "Hapus data?";
            const text = form.dataset.text || "Data yang dihapus tidak dapat dikembalikan.";
            const confirmText = form.dataset.confirm || "Ya, hapus";

            Swal.fire({
                title: title,
                text: text,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e3000b",
                cancelButtonColor: "#6b7280",
                confirmButtonText: confirmText,
                cancelButtonText: "Batal",
                reverseButtons: true,
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.classList.remove("js-confirm-delete");
                    form.submit();
                }
            });
        });
    });

    /*
    |--------------------------------------------------------------------------
    | CONFIRM LOGOUT
    |--------------------------------------------------------------------------
    | Pakai class: js-confirm-logout
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll("form.js-confirm-logout").forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            Swal.fire({
                title: "Logout?",
                text: "Anda akan keluar dari dashboard.",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#e3000b",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Ya, logout",
                cancelButtonText: "Batal",
                reverseButtons: true,
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.classList.remove("js-confirm-logout");
                    form.submit();
                }
            });
        });
    });
});