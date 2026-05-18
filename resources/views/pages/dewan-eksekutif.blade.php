@extends('layouts.guest')

@section('content')
    @include('sections.common.page-hero', [
        'title' => 'Dewan & Eksekutif',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Tentang Kami', 'url' => route('about')],
            ['label' => 'Dewan & Eksekutif'],
        ],
        'description' => 'Kepemimpinan STPI menghimpun pakar lintas sektor untuk mengarahkan strategi, memastikan akuntabilitas, dan memperkuat kemitraan nasional demi akselerasi eliminasi TBC.'
    ])
    @include('sections.dewan-eksekutif.dewan')
@endsection
