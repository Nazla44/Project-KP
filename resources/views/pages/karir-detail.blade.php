@extends('layouts.guest')

@section('content')
    @include('sections.common.page-hero', [
        'title' => 'Karir',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Karir', 'url' => route('careers')],
            ['label' => 'Detail Karir'],
        ],
        'description' => 'Bergabunglah bersama para ahli dan penggiat kesehatan publik di STPI untuk menciptakan perubahan nyata dan membangun masa depan Indonesia yang lebih sehat dan bebas dari TBC.'
    ])
    @include('sections.karir.detail')
@endsection
