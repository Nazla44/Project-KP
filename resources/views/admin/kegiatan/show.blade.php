@extends('layouts.admin')

@section('title', 'Detail Kegiatan Sosial')

@section('content')
<div class="p-6 max-w-5xl mx-auto space-y-6">
    <div class="flex items-start justify-between gap-4">
        <div>
            <div class="text-sm text-gray-500 mb-2">
                <a href="{{ route('admin.kegiatan-sosial.index') }}" class="hover:text-gray-700">Kegiatan Sosial</a>
                <span>/</span>
                <span class="text-gray-700">Detail</span>
            </div>
            <h1 class="text-2xl font-semibold text-gray-800">{{ $kegiatan->judul }}</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $kegiatan->lokasi }} · {{ $kegiatan->tanggal->format('d M Y') }}
            </p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('admin.kegiatan-sosial.edit', $kegiatan) }}"
                class="bg-yellow-500 text-white text-sm px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                Edit
            </a>
            @if($kegiatan->status !== 'draft')
                <a href="{{ route('kegiatan-sosial.show', $kegiatan->slug) }}" target="_blank"
                    class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Lihat Publik
                </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 text-sm rounded-lg px-4 py-3">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 text-sm rounded-lg px-4 py-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <img src="{{ $kegiatan->banner_url }}" alt="{{ $kegiatan->judul }}"
                    class="w-full h-64 object-cover bg-gray-100">
                <div class="p-6 space-y-4">
                    <div class="flex flex-wrap gap-2 items-center">
                        @php
                            $badgeColor = [
                                'draft' => 'bg-gray-100 text-gray-700',
                                'published' => 'bg-blue-100 text-blue-700',
                                'ongoing' => 'bg-green-100 text-green-700',
                                'completed' => 'bg-purple-100 text-purple-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                            ][$kegiatan->status] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <span class="{{ $badgeColor }} text-xs font-medium px-2 py-1 rounded-full">
                            {{ $kegiatan->status_label }}
                        </span>
                        @if($kegiatan->published_at)
                            <span class="text-xs text-gray-400">Publish:
                                {{ $kegiatan->published_at->format('d M Y H:i') }}</span>
                        @endif
                    </div>

                    <div>
                        <h2 class="font-semibold text-gray-800 mb-2">Deskripsi</h2>
                        <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $kegiatan->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-gray-800">Materi Edukasi</h2>
                    <span class="text-xs text-gray-400">{{ $kegiatan->materi->count() }} materi</span>
                </div>

                @forelse($kegiatan->materi as $materi)
                    <div class="border border-gray-100 rounded-lg p-4 mb-3">
                        <div class="font-medium text-sm text-gray-800">{{ $loop->iteration }}. {{ $materi->judul }}</div>
                        @if($materi->konten)
                            <div class="text-sm text-gray-500 mt-2 whitespace-pre-line">{{ $materi->konten }}</div>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-400">Belum ada materi.</p>
                @endforelse
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-gray-800">Dokumentasi Foto</h2>
                    <span class="text-xs text-gray-400">{{ $kegiatan->dokumentasi->count() }} foto</span>
                </div>

                <form id="formDokumentasi" action="{{ route('admin.kegiatan-sosial.upload-dokumentasi', $kegiatan) }}"
                    method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-3 mb-5">
                    @csrf
                    <input type="file" name="foto" accept="image/*" required
                        class="text-sm border border-gray-300 rounded-lg px-3 py-2 flex-1">
                    <input type="text" name="caption" placeholder="Caption opsional"
                        class="text-sm border border-gray-300 rounded-lg px-3 py-2 flex-1">
                    <button type="submit"
                        class="bg-red-700 text-white text-sm px-4 py-2 rounded-lg hover:bg-red-800 transition">
                        Upload
                    </button>
                </form>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @forelse($kegiatan->dokumentasi as $foto)
                        <div class="rounded-xl overflow-hidden border border-gray-100 bg-gray-50">
                            <img src="{{ $foto->url }}" alt="{{ $foto->caption }}"
                                class="w-full aspect-square object-cover">
                            @if($foto->caption)
                                <div class="text-xs text-gray-500 px-3 py-2">{{ $foto->caption }}</div>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 col-span-full">Belum ada dokumentasi.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="font-semibold text-gray-800 mb-4">Status Cepat</h2>
                <form action="{{ route('admin.kegiatan-sosial.update-status', $kegiatan) }}" method="POST"
                    class="space-y-3">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2">
                        @foreach(['draft' => 'Draft', 'published' => 'Akan Datang', 'ongoing' => 'Berlangsung', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $value => $label)
                            <option value="{{ $value }}" @selected($kegiatan->status === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="w-full bg-gray-800 text-white text-sm px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        Perbarui Status
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="font-semibold text-gray-800 mb-4">Kader Pelaksana</h2>
                <div class="space-y-3">
                    @forelse($kegiatan->kaders as $kader)
                    @php($namaKader = $kader->user?->name ?? $kader->nama ?? 'Kader')
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-full bg-red-100 text-red-700 flex items-center justify-center font-semibold text-sm">
                            {{ strtoupper(substr($namaKader, 0, 1)) }}
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-800">{{ $namaKader }}</div>
                            <div class="text-xs text-gray-500 capitalize">{{ $kader->pivot->peran }}</div>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-400">Belum ada kader.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="font-semibold text-gray-800 mb-4">Ringkasan Hasil</h2>
                <form action="{{ route('admin.kegiatan-sosial.ringkasan', $kegiatan) }}" method="POST"
                    class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Jumlah Peserta</label>
                        <input type="number" min="0" name="jumlah_peserta"
                            value="{{ old('jumlah_peserta', $kegiatan->ringkasan->jumlah_peserta ?? 0) }}"
                            class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Jumlah Kader</label>
                        <input type="number" min="0" name="jumlah_kader"
                            value="{{ old('jumlah_kader', $kegiatan->ringkasan->jumlah_kader ?? $kegiatan->kaders->count()) }}"
                            class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Jumlah Materi</label>
                        <input type="number" min="0" name="jumlah_materi"
                            value="{{ old('jumlah_materi', $kegiatan->ringkasan->jumlah_materi ?? $kegiatan->materi->count()) }}"
                            class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Catatan Internal</label>
                        <textarea name="catatan_internal" rows="3"
                            class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2">{{ old('catatan_internal', $kegiatan->ringkasan->catatan_internal ?? '') }}</textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-red-700 text-white text-sm px-4 py-2 rounded-lg hover:bg-red-800 transition">
                        Simpan Ringkasan
                    </button>
                </form>
            </div>
        </aside>
    </div>
</div>

@push('scripts')
    <script>
        document.getElementById('formDokumentasi')?.addEventListener('submit', async function (event) {
            event.preventDefault();

            const form = event.currentTarget;
            const button = form.querySelector('button[type="submit"]');
            const originalText = button.textContent;

            button.disabled = true;
            button.textContent = 'Mengupload...';

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error('Upload gagal. Periksa ukuran dan format file.');
                }

                window.location.reload();
            } catch (error) {
                alert(error.message);
            } finally {
                button.disabled = false;
                button.textContent = originalText;
            }
        });
    </script>
@endpush
@endsection