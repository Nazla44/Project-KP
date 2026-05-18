@extends('layouts.guest')

@push('styles')
    <link href="{{ asset('css/artikel-detail.css') }}" rel="stylesheet">
@endpush

@section('content')
    @include('sections.artikel.detail', [
        'artikel' => $article,
        'related' => $related,
        'backUrl' => route('berita'),
        'backLabel' => 'Kembali ke Berita & Kegiatan',
    ])
@endsection
