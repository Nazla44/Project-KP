@extends('layouts.admin')

@section('content')
    <section class="users-page-header">
        <div class="users-page-title">
            <span>Konten</span>
            <h1>{{ $pageTitle }}</h1>
            <p>Buat artikel baru untuk halaman berita pengunjung.</p>
        </div>
    </section>

    @if ($errors->any())
        <div class="alert users-alert users-alert-danger mb-4">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>{{ $errors->first() }}</div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.artikel._form')
    </form>
@endsection
