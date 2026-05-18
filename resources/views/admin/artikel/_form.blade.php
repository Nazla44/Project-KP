@php
    $isEdit = isset($artikel);
@endphp

<div class="row g-4">
    <div class="col-12 col-lg-8">
        <div class="users-table-card">
            <div class="users-table-header">
                <div>
                    <h2>{{ $isEdit ? 'Edit Konten Artikel' : 'Konten Artikel Baru' }}</h2>
                    <p>Isi judul, topik, dan isi artikel yang akan ditampilkan kepada pengunjung.</p>
                </div>
            </div>

            <div class="p-4">
                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Artikel</label>
                    <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul', $artikel->judul ?? '') }}"
                        placeholder="Masukkan judul artikel" required>
                </div>

                <div class="mb-3">
                    <label for="topik" class="form-label fw-semibold">Topik</label>
                    <input type="text" id="topik" name="topik" class="form-control" value="{{ old('topik', $artikel->topik ?? '') }}"
                        placeholder="Contoh: Seputar TBC" required>
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label fw-semibold">Isi Artikel</label>
                    <textarea id="isi" name="isi" rows="16" class="form-control" placeholder="Tulis isi artikel di sini..." required>{{ old('isi', $artikel->isi ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="users-table-card mb-4">
            <div class="users-table-header">
                <div>
                    <h2>Publikasi</h2>
                    <p>Tentukan apakah artikel langsung tayang atau disimpan sebagai draft.</p>
                </div>
            </div>

            <div class="p-4">
                <div class="mb-3">
                    <label for="status" class="form-label fw-semibold">Status</label>
                    <select id="status" name="status" class="form-select" required>
                        <option value="draft" @selected(old('status', $artikel->status ?? 'draft') === 'draft')>Draft</option>
                        <option value="tayang" @selected(old('status', $artikel->status ?? '') === 'tayang')>Tayang</option>
                    </select>
                </div>

                <div class="mb-0">
                    <label for="cover_image" class="form-label fw-semibold">Cover Artikel</label>
                    <input type="file" id="cover_image" name="cover_image" class="form-control" accept=".jpg,.jpeg,.png,.webp"
                        {{ $isEdit ? '' : 'required' }}>
                    <div class="users-form-help mt-2">Format: JPG, JPEG, PNG, WEBP. Maksimal 3 MB.</div>
                </div>
            </div>
        </div>

        @if ($isEdit && $artikel->cover_image_url)
            <div class="users-table-card">
                <div class="users-table-header">
                    <div>
                        <h2>Cover Saat Ini</h2>
                        <p>Preview cover yang sedang digunakan artikel ini.</p>
                    </div>
                </div>

                <div class="p-4">
                    <img src="{{ $artikel->cover_image_url }}" alt="{{ $artikel->judul }}" class="img-fluid rounded-4 border">
                </div>
            </div>
        @endif
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.articles.index') }}" class="btn btn-light px-4">Kembali</a>
    <button type="submit" class="btn btn-danger px-4">{{ $isEdit ? 'Simpan Perubahan' : 'Simpan Artikel' }}</button>
</div>
