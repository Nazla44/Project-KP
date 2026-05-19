<div class="row g-3">

    <div class="col-md-8">
        <label for="judul" class="form-label">Judul Artikel</label>
        <input
            type="text"
            name="judul"
            id="judul"
            class="form-control @error('judul') is-invalid @enderror"
            value="{{ old('judul', $artikel->judul ?? '') }}"
            placeholder="Masukkan judul artikel"
            required
        >

        @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="kategori" class="form-label">Kategori</label>
        <input
            type="text"
            name="kategori"
            id="kategori"
            class="form-control @error('kategori') is-invalid @enderror"
            value="{{ old('kategori', $artikel->kategori ?? '') }}"
            placeholder="Contoh: Edukasi TBC"
            required
        >

        @error('kategori')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="penulis" class="form-label">Penulis</label>
        <input
            type="text"
            name="penulis"
            id="penulis"
            class="form-control @error('penulis') is-invalid @enderror"
            value="{{ old('penulis', $artikel->penulis ?? '') }}"
            placeholder="Nama penulis"
            required
        >

        @error('penulis')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input
            type="date"
            name="tanggal"
            id="tanggal"
            class="form-control @error('tanggal') is-invalid @enderror"
            value="{{ old('tanggal', isset($artikel) && $artikel ? $artikel->tanggal : date('Y-m-d')) }}"
            required
        >

        @error('tanggal')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <select
            name="status"
            id="status"
            class="form-select @error('status') is-invalid @enderror"
            required
        >
            <option value="draft" {{ old('status', $artikel->status ?? '') == 'draft' ? 'selected' : '' }}>
                Draft
            </option>
            <option value="tayang" {{ old('status', $artikel->status ?? '') == 'tayang' ? 'selected' : '' }}>
                Tayang
            </option>
        </select>

        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="isi" class="form-label">Isi Artikel</label>
        <textarea
            name="isi"
            id="isi"
            rows="8"
            class="form-control @error('isi') is-invalid @enderror"
            placeholder="Tulis isi artikel di sini..."
            required
        >{{ old('isi', $artikel->isi ?? '') }}</textarea>

        @error('isi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('artikel.index') }}" class="btn btn-light">
        Batal
    </a>

    <button type="submit" class="btn btn-danger">
        <i class="bi bi-save me-1"></i>
        Simpan Artikel
    </button>
</div>