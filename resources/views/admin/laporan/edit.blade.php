@extends('admin.layouts.master')

@section('title', 'Edit Laporan - STPI Admin')
@section('page-title', 'Edit Laporan')
@section('page-subtitle', 'Perbarui dokumen laporan')

@section('content')

<div class="card content-card">
    <div class="card-body p-4">
        <form 
            method="POST" 
            action="{{ route('laporan.update', $laporan->id) }}" 
            enctype="multipart/form-data"
            class="form-confirm"
            data-title="Yakin ingin memperbarui laporan?"
            data-text="Perubahan data laporan akan disimpan."
            data-confirm="Ya, perbarui"
        >
            @csrf
            @method('PUT')

            @include('admin.laporan.partials.form', ['laporan' => $laporan])
        </form>
    </div>
</div>

@endsection