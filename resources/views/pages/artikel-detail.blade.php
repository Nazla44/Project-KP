@extends('layouts.app')

@section('title', $artikel['title'] . ' – Stop TB Partnership Indonesia')

@push('styles')
    <link href="{{ asset('css/artikel-detail.css') }}" rel="stylesheet">
@endpush

@section('content')
    @include('sections.artikel.detail', [
        'artikel' => $artikel,
        'related' => $related,
        'backUrl' => $backUrl,
        'backLabel' => $backLabel,
    ])
@endsection
