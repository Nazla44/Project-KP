@extends('layouts.guest')

@section('title', 'Program Komunitas – Stop TB Partnership Indonesia')

@push('styles')
    <link href="{{ asset('css/program-komunitas.css') }}" rel="stylesheet">
@endpush

@section('content')

    @include('sections.program-komunitas.hero')
    @include('sections.program-komunitas.tentang')
    @include('sections.program-komunitas.pilars', ['pilars' => $pilars])
    @include('sections.program-komunitas.mitra', ['mitra' => $mitra])
    @include('sections.program-komunitas.stories', ['stories' => $stories])
    @include('sections.program-komunitas.faq', ['faqs' => $faqs])

@endsection

@push('scripts')
    <script>
        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('pk-visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.pk-reveal').forEach(el => observer.observe(el));
    </script>
@endpush
