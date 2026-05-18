@extends('layouts.guest')

@section('content')
    @include('sections.berita.list', ['page' => $beritaPage])
@endsection
