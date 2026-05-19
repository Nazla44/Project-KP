@extends('admin.layouts.master')

@section('title', 'Tambah Kader - STPI')
@section('page_title', 'Tambah Kader')
@section('page_subtitle', 'Isi data kader baru.')

@section('content')
    <div class="card card-soft">
        <div class="card-body">
            <form 
                method="POST" 
                action="{{ route('kader.store') }}"
                class="form-confirm"
                data-title="Yakin ingin menambahkan data kader?"
                data-text="Data kader akan disimpan ke dashboard admin."
                data-confirm="Ya, tambah kader"
            >
                @csrf

                @include('admin.kader.partials.form', ['kader' => null])
            </form>
        </div>
    </div>
@endsection
