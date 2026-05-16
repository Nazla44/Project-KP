@extends('layouts.app')

@section('content')
    @include('sections.home.hero')
    @include('sections.home.about')
    @include('sections.home.tuberculosis-info')
    @include('sections.home.stats')
    @include('sections.home.call')
    @include('sections.home.news')
@endsection
