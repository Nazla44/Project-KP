{{-- resources/views/admin/kegiatan-sosial/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Kegiatan Sosial')

@section('content')
    <div class="p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-semibold text-gray-800">Kegiatan Sosial</h1>
                <p class="text-sm text-gray-500 mt-0.5">Kelola program sosialisasi TBC</p>
            </div>
            <a href="{{ route('admin.kegiatan-sosial.create') }}"
                class="inline-flex items-center gap-2 bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-red-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kegiatan
            </a>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 text-sm rounded-lg px-4 py-3 mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 text-sm rounded-lg px-4 py-3 mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Filter --}}
        <form method="GET" class="flex gap-3 mb-5">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..."
                class="text-sm border border-gray-300 rounded-lg px-3 py-2 w-64 focus:ring-2 focus:ring-red-500">
            <select name="status"
                class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500">
                <option value="">Semua Status</option>
                @foreach(['draft', 'published', 'ongoing', 'completed', 'cancelled'] as $s)
                    <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-gray-800 text-white text-sm px-4 py-2 rounded-lg hover:bg-gray-700">
                Filter
            </button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.kegiatan-sosial.index') }}"
                    class="text-sm text-gray-500 hover:text-gray-700 self-center">Reset</a>
            @endif
        </form>

        {{-- Tabel --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 text-gray-600 font-medium">Kegiatan</th>
                        <th class="text-left px-4 py-3 text-gray-600 font-medium">Tanggal</th>
                        <th class="text-left px-4 py-3 text-gray-600 font-medium">Status</th>
                        <th class="text-left px-4 py-3 text-gray-600 font-medium">Kader</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($kegiatan as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    @if($item->banner)
                                        <img src="{{ $item->banner_url }}" alt=""
                                            class="w-10 h-10 rounded-lg object-cover flex-shrink-0 bg-gray-100">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-gray-800">{{ Str::limit($item->judul, 45) }}</div>
                                        <div class="text-xs text-gray-400 mt-0.5">{{ $item->lokasi }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-gray-600">
                                {{ $item->tanggal->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4">
                                @php
                                    $badgeColor = [
                                        'draft' => 'bg-gray-100 text-gray-700',
                                        'published' => 'bg-blue-100 text-blue-700',
                                        'ongoing' => 'bg-green-100 text-green-700',
                                        'completed' => 'bg-purple-100 text-purple-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                    ][$item->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="{{ $badgeColor }} text-xs font-medium px-2 py-0.5 rounded-full">
                                    {{ $item->status_label }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-gray-600">
                                {{ $item->kaders->count() }} kader
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-2 justify-end">
                                    <a href="{{ route('admin.kegiatan-sosial.show', $item) }}"
                                        class="text-gray-400 hover:text-blue-600 transition" title="Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.kegiatan-sosial.edit', $item) }}"
                                        class="text-gray-400 hover:text-yellow-600 transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.kegiatan-sosial.destroy', $item) }}" method="POST"
                                        onsubmit="return confirm('Hapus kegiatan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center text-gray-400">
                                Belum ada kegiatan sosial.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($kegiatan->hasPages())
                <div class="px-5 py-4 border-t border-gray-100">
                    {{ $kegiatan->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection