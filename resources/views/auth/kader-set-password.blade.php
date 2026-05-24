@extends('layouts.guest')

@section('title', 'Buat Password Kader – Stop TB Partnership Indonesia')

@section('content')
    <section class="py-5" style="background:#f8fafc; min-height:70vh;">
        <div class="container-xl px-4 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-7 col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 p-lg-5">
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <i class="bi bi-shield-lock-fill" style="font-size: 42px; color:#c31513;"></i>
                                </div>
                                <h1 class="h4 fw-bold mb-2">Buat Password Kader</h1>
                                <p class="text-muted mb-0">
                                    Masukkan password baru untuk mengaktifkan akun kader Anda.
                                </p>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Gagal membuat password.</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('kader.password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $email) }}" required autocomplete="email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">Password Baru</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" required
                                        autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Minimal 8 karakter.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi
                                        Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" required autocomplete="new-password">
                                </div>

                                <button type="submit" class="btn w-100 text-white fw-semibold" style="background:#c31513;">
                                    Simpan Password
                                </button>
                            </form>

                            <p class="text-muted small text-center mt-4 mb-0">
                                Link ini hanya dapat digunakan satu kali.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
