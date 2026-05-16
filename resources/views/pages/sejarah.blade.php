@extends('layouts.app')

@section('content')
    @include('sections.common.page-hero', [
        'title' => 'Sejarah',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Tentang Kami', 'url' => route('about')],
            ['label' => 'Sejarah'],
        ],
        'description' => 'Menelusuri jejak dedikasi Stop TB Partnership Indonesia dalam membangun kemitraan strategis dan menggerakkan aksi nyata demi mewujudkan Indonesia bebas TBC.'
    ])
    @include('sections.sejarah.journey')
@endsection
