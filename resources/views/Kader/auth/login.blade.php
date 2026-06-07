@extends('layouts.kader')

@section('title', 'Login Kader')

@section('auth_plain', true)

@section('content')
    <div class="kader-auth-page">
        <div class="kader-auth-wrapper">

            <div class="brand-wrap">
                <img src="{{ asset('assets/image/image.png') }}" alt="Stop TB Partnership Indonesia" class="brand-logo">
            </div>

            <div class="kader-auth-card">
                <h1 class="kader-auth-title">Selamat Datang</h1>

                <p class="kader-auth-subtitle">
                    Mohon masukkan detail Anda untuk masuk
                </p>

                @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('kader.login.submit') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="kader-auth-label">Email Address</label>

                        <input
                            type="text"
                            name="login"
                            value="{{ old('login') }}"
                            class="kader-auth-input"
                            placeholder="name@example.com"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-0">
                        <label class="kader-auth-label">Password</label>

                        <input
                            type="password"
                            name="password"
                            class="kader-auth-input"
                            placeholder="Enter your password"
                            required
                        >
                    </div>

                    <label class="kader-auth-check">
                        <input type="checkbox" name="remember" value="1">
                        <span>Ingat saya</span>
                    </label>

                    <button type="submit" class="kader-auth-button">
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection