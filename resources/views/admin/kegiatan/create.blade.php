{{-- resources/views/admin/kegiatan-sosial/create.blade.php --}}
{{-- Gunakan blade yang sama untuk edit dengan: @include('admin.kegiatan-sosial._form') --}}

@extends('layouts.admin')

@section('title', isset($kegiatan) ? 'Edit Kegiatan' : 'Tambah Kegiatan Sosial')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2">
        <a href="{{ route('admin.kegiatan-sosial.index') }}" class="hover:text-gray-700">Kegiatan Sosial</a>
        <span>/</span>
        <span class="text-gray-700">{{ isset($kegiatan) ? 'Edit' : 'Tambah Baru' }}</span>
    </nav>

    <h1 class="text-xl font-semibold text-gray-800 mb-6">
        {{ isset($kegiatan) ? 'Edit Kegiatan' : 'Tambah Kegiatan Sosial' }}
    </h1>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3 mb-6">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ isset($kegiatan) ? route('admin.kegiatan-sosial.update', $kegiatan) : route('admin.kegiatan-sosial.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-8">

        @csrf
        @if(isset($kegiatan)) @method('PUT') @endif

        {{-- ====================================================
             BAGIAN 1: Informasi Utama
        ==================================================== --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-medium text-gray-700 text-sm">Informasi Utama</h2>
            </div>
            <div class="p-6 space-y-5">

                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Judul Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul"
                           value="{{ old('judul', $kegiatan->judul ?? '') }}"
                           placeholder="Contoh: Sosialisasi TBC Kelurahan Tembalang"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent @error('judul') border-red-400 @enderror">
                    @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Tanggal & Waktu --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal"
                               value="{{ old('tanggal', isset($kegiatan) ? $kegiatan->tanggal->format('Y-m-d') : '') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 @error('tanggal') border-red-400 @enderror">
                        @error('tanggal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
                        <input type="time" name="jam_mulai"
                               value="{{ old('jam_mulai', substr($kegiatan->jam_mulai ?? '', 0, 5)) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai</label>
                        <input type="time" name="jam_selesai"
                               value="{{ old('jam_selesai', substr($kegiatan->jam_selesai ?? '', 0, 5)) }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500">
                    </div>
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Lokasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="lokasi"
                           value="{{ old('lokasi', $kegiatan->lokasi ?? '') }}"
                           placeholder="Nama tempat, alamat lengkap"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 @error('lokasi') border-red-400 @enderror">
                    @error('lokasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Koordinat (opsional) --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Latitude <span class="text-gray-400 font-normal">(opsional, untuk peta)</span>
                        </label>
                        <input type="number" name="latitude" step="0.0000001"
                               value="{{ old('latitude', $kegiatan->latitude ?? '') }}"
                               placeholder="-7.0256"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                        <input type="number" name="longitude" step="0.0000001"
                               value="{{ old('longitude', $kegiatan->longitude ?? '') }}"
                               placeholder="110.4381"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" rows="5"
                              placeholder="Jelaskan tujuan dan gambaran kegiatan..."
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 @error('deskripsi') border-red-400 @enderror">{{ old('deskripsi', $kegiatan->deskripsi ?? '') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Banner --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Banner / Thumbnail
                        <span class="text-gray-400 font-normal">(JPG/PNG, maks 2MB)</span>
                    </label>
                    @if(isset($kegiatan) && $kegiatan->banner)
                        <div class="mb-2">
                            <img src="{{ $kegiatan->banner_url }}" alt="Banner saat ini"
                                 class="h-24 rounded-lg object-cover">
                            <p class="text-xs text-gray-400 mt-1">Upload baru untuk mengganti</p>
                        </div>
                    @endif
                    <input type="file" name="banner" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-sm file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    @error('banner') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                            class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500">
                        <option value="draft"     @selected(old('status', $kegiatan->status ?? 'draft') === 'draft')>Draft (tidak tampil publik)</option>
                        <option value="published" @selected(old('status', $kegiatan->status ?? '') === 'published')>Published (tampil publik)</option>
                        @if(isset($kegiatan))
                        <option value="ongoing"   @selected($kegiatan->status === 'ongoing')>Berlangsung</option>
                        <option value="completed" @selected($kegiatan->status === 'completed')>Selesai</option>
                        <option value="cancelled" @selected($kegiatan->status === 'cancelled')>Dibatalkan</option>
                        @endif
                    </select>
                </div>

            </div>
        </div>

        {{-- ====================================================
             BAGIAN 2: Kader Pelaksana
        ==================================================== --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="font-medium text-gray-700 text-sm">Kader Pelaksana</h2>
            </div>
            <div class="p-6">
                @if($kaders->isEmpty())
                    <p class="text-sm text-gray-400">Belum ada kader aktif.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($kaders as $kader)
                        @php $isSelected = in_array($kader->id, $selectedKaderIds ?? []); @endphp
                        <label class="flex items-start gap-3 p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition
                                      {{ $isSelected ? 'border-red-400 bg-red-50' : 'border-gray-200' }}">
                            <input type="checkbox" name="kader_ids[]" value="{{ $kader->id }}"
                                   {{ $isSelected ? 'checked' : '' }}
                                   class="mt-0.5 rounded text-red-600 focus:ring-red-500"
                                   onchange="togglePeran(this, {{ $kader->id }})">
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-800">{{ $kader->user?->name ?? $kader->nama }}</div>
                                <div class="text-xs text-gray-400">{{ $kader->nik ?? '-' }}</div>
                                <select name="peran_kader[{{ $kader->id }}]"
                                        id="peran_{{ $kader->id }}"
                                        class="mt-2 w-full text-xs border border-gray-300 rounded-lg px-2 py-1 focus:ring-red-500
                                               {{ !$isSelected ? 'opacity-40 pointer-events-none' : '' }}">
                                    @php
                                        $currentPeran = old(
                                            "peran_kader.{$kader->id}",
                                            isset($kegiatan)
                                                ? ($kegiatan->kaders->firstWhere('id', $kader->id)?->pivot->peran ?? 'pelaksana')
                                                : 'pelaksana'
                                        );
                                    @endphp
                                    <option value="pelaksana"   @selected($currentPeran === 'pelaksana')>Pelaksana</option>
                                    <option value="koordinator" @selected($currentPeran === 'koordinator')>Koordinator</option>
                                    <option value="pendamping"  @selected($currentPeran === 'pendamping')>Pendamping</option>
                                </select>
                            </div>
                        </label>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- ====================================================
             BAGIAN 3: Materi Edukasi
        ==================================================== --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <h2 class="font-medium text-gray-700 text-sm">Materi Edukasi TBC</h2>
                <button type="button" onclick="tambahMateri()"
                        class="text-xs text-red-700 border border-red-300 rounded-lg px-3 py-1 hover:bg-red-50 transition">
                    + Tambah Materi
                </button>
            </div>
            <div class="p-6">
                <div id="materi-list" class="space-y-3">
                    @php
                        $existingMateri = $kegiatan->materi ?? collect($materiDefault ?? []);
                    @endphp
                    @foreach($existingMateri as $i => $m)
                    <div class="materi-item flex gap-3 items-start bg-gray-50 rounded-xl p-4">
                        <div class="flex-1 space-y-2">
                            <input type="text"
                                   name="materi[{{ $i }}][judul]"
                                   value="{{ old("materi.{$i}.judul", is_array($m) ? $m['judul'] : $m->judul) }}"
                                   placeholder="Judul materi"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500">
                            <textarea name="materi[{{ $i }}][konten]" rows="2"
                                      placeholder="Isi materi (opsional)"
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 resize-none">{{ old("materi.{$i}.konten", is_array($m) ? '' : $m->konten) }}</textarea>
                            <input type="hidden" name="materi[{{ $i }}][urutan]" value="{{ $i + 1 }}">
                        </div>
                        <button type="button" onclick="this.closest('.materi-item').remove()"
                                class="text-gray-300 hover:text-red-500 mt-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex gap-3">
            <button type="submit"
                    class="bg-red-700 text-white text-sm font-medium px-6 py-2.5 rounded-lg hover:bg-red-800 transition">
                {{ isset($kegiatan) ? 'Simpan Perubahan' : 'Buat Kegiatan' }}
            </button>
            <a href="{{ route('admin.kegiatan-sosial.index') }}"
               class="text-sm text-gray-600 border border-gray-300 px-6 py-2.5 rounded-lg hover:bg-gray-50 transition">
                Batal
            </a>
        </div>

    </form>
</div>

@push('scripts')
<script>
let materiIndex = {{ count($existingMateri ?? $materiDefault ?? []) }};

function tambahMateri() {
    const html = `
    <div class="materi-item flex gap-3 items-start bg-gray-50 rounded-xl p-4">
        <div class="flex-1 space-y-2">
            <input type="text" name="materi[${materiIndex}][judul]"
                   placeholder="Judul materi"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500">
            <textarea name="materi[${materiIndex}][konten]" rows="2"
                      placeholder="Isi materi (opsional)"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 resize-none"></textarea>
            <input type="hidden" name="materi[${materiIndex}][urutan]" value="${materiIndex + 1}">
        </div>
        <button type="button" onclick="this.closest('.materi-item').remove()"
                class="text-gray-300 hover:text-red-500 mt-1 flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>`;
    document.getElementById('materi-list').insertAdjacentHTML('beforeend', html);
    materiIndex++;
}

function togglePeran(checkbox, kaderId) {
    const select = document.getElementById('peran_' + kaderId);
    if (checkbox.checked) {
        select.classList.remove('opacity-40', 'pointer-events-none');
        checkbox.closest('label').classList.add('border-red-400', 'bg-red-50');
        checkbox.closest('label').classList.remove('border-gray-200');
    } else {
        select.classList.add('opacity-40', 'pointer-events-none');
        checkbox.closest('label').classList.remove('border-red-400', 'bg-red-50');
        checkbox.closest('label').classList.add('border-gray-200');
    }
}
</script>
@endpush

@endsection