@extends('admin.layouts.master')

@section('title', 'Tambah Laporan - STPI Admin')
@section('page-title', 'Tambah Laporan')
@section('page-subtitle', 'Upload dokumen laporan baru')

@section('content')

<div class="card content-card">
    <div class="card-body p-4">
        <form 
            method="POST" 
            action="{{ route('laporan.store') }}" 
            enctype="multipart/form-data"
            class="form-confirm"
            data-title="Yakin ingin mengupload laporan?"
            data-text="File laporan akan disimpan dan dapat ditampilkan di website."
            data-confirm="Ya, upload laporan"
        >
            @csrf

            @include('admin.laporan.partials.form', ['laporan' => null])
        </form>
    </div>
</div>

@endsection