@extends('admin.layouts.master')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow text-center">
                <h2 class="text-gray-500">Total Kader</h2>
                <p class="text-green-600 text-2xl">{{ $totalKader }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <h2 class="text-gray-500">Total Klinik</h2>
                <p class="text-green-600 text-2xl">{{ $totalKlinik }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow text-center">
                <h2 class="text-gray-500">Artikel Tayang</h2>
                <p class="text-red-600 text-2xl">{{ $totalArtikel }}</p>
            </div>
        </div>

    </div>
@endsection