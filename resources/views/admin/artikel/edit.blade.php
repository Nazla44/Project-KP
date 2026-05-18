@extends('layouts.admin')

@section('content')
    <section class="users-page-header">
        <div class="users-page-title">
            <span>Konten</span>
            <h1>{{ $pageTitle }}</h1>
            <p>Perbarui artikel tanpa mengubah tampilan admin yang sudah ada.</p>
        </div>
    </section>

    @if ($errors->any())
        <div class="alert users-alert users-alert-danger mb-4">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>{{ $errors->first() }}</div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.articles.update', $artikel) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.artikel._form', ['artikel' => $artikel])
    </form>
@endsection
