@extends('admin.layouts.master')

@section('content')
    <h2 class="text-xl font-bold mb-4">Manajemen Kader</h2>
    <a href="{{ route('kader.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah
        Kader</a>
    <table class="w-full table-auto bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Klinik</th>
                <th class="px-4 py-2">No HP</th>
                <th class="px-4 py-2">Bergabung</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kaders as $kader)
                <tr>
                    <td class="border px-4 py-2">{{ $kader->nama }}</td>
                    <td class="border px-4 py-2">{{ $kader->klinik->nama ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $kader->hp }}</td>
                    <td class="border px-4 py-2">{{ $kader->tgl_bergabung }}</td>
                    <td class="border px-4 py-2">
                        @if($kader->status == 'aktif')
                            <span class="text-green-600 font-bold">Aktif</span>
                        @else
                            <span class="text-yellow-500 font-bold">Verifikasi</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2">
                        @if($kader->status != 'aktif')
                            <form method="POST" action="{{ route('kader.verifikasi', $kader->id) }}" class="inline">
                                @csrf
                                <button class="bg-blue-500 text-white px-2 py-1 rounded">Verifikasi</button>
                            </form>
                        @endif
                        <a href="{{ route('kader.edit', $kader->id) }}"
                            class="bg-gray-500 text-white px-2 py-1 rounded">Edit</a>
                        <form method="POST" action="{{ route('kader.destroy', $kader->id) }}" class="inline">
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