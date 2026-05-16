@extends('layouts.app')

@section('content')
    @include('sections.common.page-hero', [
        'title' => 'Akuntabilitas',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Akuntabilitas'],
        ],
        'description' => 'Wujud nyata komitmen Stop TB Partnership Indonesia dalam menjaga transparansi dan integritas melalui pelaporan kinerja serta pengelolaan sumber daya yang akuntabel bagi seluruh pemangku kepentingan.'
    ])
    @include('sections.akuntabilitas.intro')
    @include('sections.akuntabilitas.table', [
        'wrapperClass' => 'laporan-wrapper',
        'titleStart' => 'Laporan Tahunan',
        'page' => $laporanPage,
    ])
    @include('sections.akuntabilitas.table', [
        'wrapperClass' => 'dokumen-wrapper',
        'titleStart' => 'Dokumen',
        'page' => $dokumenPage,
    ])
@endsection
