@extends('admin.layouts.master')

@section('title', 'Tambah Artikel - STPI')
@section('page_title', 'Tambah Artikel')
@section('page_subtitle', 'Isi data artikel baru.')

@section('content')
    <div class="card card-soft">
        <div class="card-body">
            <form 
                method="POST" 
                action="{{ route('artikel.store') }}"
                class="form-confirm"
                data-title="Yakin ingin menambahkan artikel?"
                data-text="Artikel akan disimpan ke dashboard admin."
                data-confirm="Ya, tambah artikel"
            >
                @csrf

                @include('admin.artikel.partials.form', ['artikel' => null])
            </form>
        </div>
    </div>
@endsection
