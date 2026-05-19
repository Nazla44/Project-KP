@extends('admin.layouts.master')

@section('title', 'Edit Kader - STPI')
@section('page_title', 'Edit Kader')
@section('page_subtitle', 'Perbarui data kader.')

@section('content')
    <div class="card card-soft">
        <div class="card-body">
            <form 
                method="POST" 
                action="{{ route('kader.update', $kader->id) }}"
                class="form-confirm"
                data-title="Yakin ingin memperbarui data kader?"
                data-text="Perubahan data kader akan disimpan."
                data-confirm="Ya, perbarui"
            >
                @csrf
                @method('PUT')

                @include('admin.kader.partials.form', ['kader' => $kader])
            </form>
        </div>
    </div>
@endsection
