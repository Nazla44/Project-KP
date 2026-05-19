<div class="row g-3">

    <div class="col-md-8">
        <label class="form-label">Nama Laporan</label>
        <input
            type="text"
            name="nama"
            class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $laporan->nama ?? '') }}"
            placeholder="Contoh: Laporan Tahunan STPI 2025"
            required
        >

        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Kategori</label>
        <input
            type="text"
            name="kategori"
            class="form-control @error('kategori') is-invalid @enderror"
            value="{{ old('kategori', $laporan->kategori ?? 'Laporan Tahunan') }}"
            required
        >

        @error('kategori')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tanggal Upload / Terbit</label>
        <input
            type="date"
            name="tanggal"
            class="form-control @error('tanggal') is-invalid @enderror"
            value="{{ old('tanggal', isset($laporan) ? $laporan->tanggal : date('Y-m-d')) }}"
            required
        >

        @error('tanggal')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="tayang" {{ old('status', $laporan->status ?? '') === 'tayang' ? 'selected' : '' }}>
                Tayang
            </option>
            <option value="draft" {{ old('status', $laporan->status ?? '') === 'draft' ? 'selected' : '' }}>
                Draft
            </option>
        </select>

        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">File Laporan</label>
        <input
            type="file"
            name="file"
            class="form-control @error('file') is-invalid @enderror"
            {{ isset($laporan) ? '' : 'required' }}
        >

        <small class="text-muted">
            Format: PDF, DOC, DOCX, XLS, XLSX. Maksimal 5 MB.
        </small>

        @if (isset($laporan) && $laporan->file)
            <div class="mt-2">
                <a href="{{ asset('storage/' . $laporan->file) }}" target="_blank">
                    Lihat file saat ini
                </a>
            </div>
        @endif

        @error('file')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('laporan.index') }}" class="btn btn-light">
        Batal
    </a>

    <button type="submit" class="btn btn-danger">
        <i class="bi bi-save me-1"></i>
        Simpan Laporan
    </button>
</div>