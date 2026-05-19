@extends('admin.layouts.master')

@section('title', 'Edit Klinik - STPI')
@section('page_title', 'Edit Klinik')
@section('page_subtitle', 'Perbarui data fasilitas kesehatan mitra.')

@section('content')
    <div class="card card-soft">
        <div class="card-body">
            <form 
                method="POST" 
                action="{{ route('klinik.update', $klinik->id) }}"
                class="form-confirm"
                data-title="Yakin ingin memperbarui data klinik?"
                data-text="Perubahan data klinik akan disimpan."
                data-confirm="Ya, perbarui"
            >
                @csrf
                @method('PUT')

                @include('admin.klinik.partials.form', ['klinik' => $klinik])
            </form>
        </div>
    </div>
@endsection
