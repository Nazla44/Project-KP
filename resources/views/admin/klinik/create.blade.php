@extends('admin.layouts.master')

@section('title', 'Tambah Klinik - STPI')
@section('page_title', 'Tambah Klinik')
@section('page_subtitle', 'Isi data fasilitas kesehatan mitra.')

@section('content')
    <div class="card card-soft">
        <div class="card-body">
            <form 
                method="POST" 
                action="{{ route('klinik.store') }}"
                class="form-confirm"
                data-title="Yakin ingin menambahkan data klinik?"
                data-text="Data klinik akan disimpan dan dapat ditampilkan di website."
                data-confirm="Ya, tambah klinik"
            >
                @csrf

                @include('admin.klinik.partials.form', ['klinik' => null])
            </form>
        </div>
    </div>
@endsection
