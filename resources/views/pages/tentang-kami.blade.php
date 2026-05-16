@extends('layouts.app')

@section('content')
    @include('sections.common.page-hero', [
        'title' => 'Tentang Kami',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Tentang Kami'],
        ],
        'description' => 'Mengenal Stop TB Partnership Indonesia (STPI) sebagai wadah kolaborasi nasional yang menghimpun berbagai pemangku kepentingan untuk mengakselerasi upaya eliminasi TBC.'
    ])
    @include('sections.tentang-kami.profile')
    @include('sections.tentang-kami.stats')
    @include('sections.tentang-kami.history')
    @include('sections.tentang-kami.dewan')
@endsection
