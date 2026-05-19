<div class="row g-3">

    <div class="col-md-6">
        <label for="nama" class="form-label">Nama Kader</label>
        <input
            type="text"
            name="nama"
            id="nama"
            class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $kader->nama ?? '') }}"
            placeholder="Masukkan nama kader"
            required
        >

        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input
            type="email"
            name="email"
            id="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $kader->email ?? '') }}"
            placeholder="contoh@email.com"
            required
        >

        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="telepon" class="form-label">Nomor Telepon</label>
        <input
            type="text"
            name="telepon"
            id="telepon"
            class="form-control @error('telepon') is-invalid @enderror"
            value="{{ old('telepon', $kader->telepon ?? '') }}"
            placeholder="Contoh: 081234567890"
            required
        >

        @error('telepon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="wilayah" class="form-label">Wilayah</label>
        <input
            type="text"
            name="wilayah"
            id="wilayah"
            class="form-control @error('wilayah') is-invalid @enderror"
            value="{{ old('wilayah', $kader->wilayah ?? '') }}"
            placeholder="Contoh: Jakarta Selatan"
            required
        >

        @error('wilayah')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="status" class="form-label">Status</label>
        <select
            name="status"
            id="status"
            class="form-select @error('status') is-invalid @enderror"
            required
        >
            <option value="aktif" {{ old('status', $kader->status ?? '') === 'aktif' ? 'selected' : '' }}>
                Aktif
            </option>

            <option value="nonaktif" {{ old('status', $kader->status ?? '') === 'nonaktif' ? 'selected' : '' }}>
                Nonaktif
            </option>
        </select>

        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('kader.index') }}" class="btn btn-light">
        Batal
    </a>

    <button type="submit" class="btn btn-danger">
        <i class="bi bi-save me-1"></i>
        Simpan Kader
    </button>
</div>