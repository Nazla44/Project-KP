@extends('admin.layouts.master')

@section('content')
    <h2 class="text-xl font-bold mb-4">Manajemen Artikel</h2>
    <a href="{{ route('artikel.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah
        Artikel</a>
    <table class="w-full table-auto bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Judul</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Penulis</th>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artikel as $a)
                <tr>
                    <td class="border px-4 py-2">{{ $a->judul }}</td>
                    <td class="border px-4 py-2">{{ $a->kategori }}</td>
                    <td class="border px-4 py-2">{{ $a->penulis }}</td>
                    <td class="border px-4 py-2">{{ $a->tanggal }}</td>
                    <td class="border px-4 py-2">
                        @if($a->status == 'tayang')
                            <span class="text-green-600 font-bold">Tayang</span>
                        @else
                            <span class="text-yellow-500 font-bold">Draft</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if($a->status != 'tayang')
                            <form method="POST" action="{{ route('artikel.publish', $a->id) }}" class="inline">
                                @csrf
                                <button class="bg-blue-500 text-white px-2 py-1 rounded">Publish</button>
                            </form>
                        @endif
                        <a href="{{ route('artikel.edit', $a->id) }}" class="bg-gray-500 text-white px-2 py-1 rounded">Edit</a>
                        <form method="POST" action="{{ route('artikel.destroy', $a->id) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-2 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection