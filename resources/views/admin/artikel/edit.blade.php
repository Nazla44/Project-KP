@extends('admin.layouts.master')

@section('title', 'Edit Artikel - STPI')
@section('page_title', 'Edit Artikel')
@section('page_subtitle', 'Perbarui data artikel.')

@section('content')
    <div class="card card-soft">
        <div class="card-body">
            <form 
                method="POST" 
                action="{{ route('artikel.update', $artikel->id) }}"
                class="form-confirm"
                data-title="Yakin ingin memperbarui artikel?"
                data-text="Perubahan artikel akan disimpan."
                data-confirm="Ya, perbarui"
            >
                @csrf
                @method('PUT')

                @include('admin.artikel.partials.form', ['artikel' => $artikel])
            </form>
        </div>
    </div>
@endsection
