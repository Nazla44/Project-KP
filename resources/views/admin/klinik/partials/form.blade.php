@php
    $klinik = $klinik ?? null;
    $layananValue = old('layanan', isset($klinik->layanan) && is_array($klinik->layanan) ? implode(', ', $klinik->layanan) : '');
@endphp

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Nama Klinik</label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $klinik->nama ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Tipe</label>
        <select name="tipe" class="form-select" required>
            @foreach (['Puskesmas', 'RS Umum', 'Klinik'] as $tipe)
                <option value="{{ $tipe }}" @selected(old('tipe', $klinik->tipe ?? 'Klinik') === $tipe)>{{ $tipe }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Kota / Kabupaten</label>
        <input type="text" name="kota" class="form-control" value="{{ old('kota', $klinik->kota ?? '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Provinsi</label>
        <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $klinik->provinsi ?? '') }}">
    </div>

    <div class="col-12">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" rows="3" class="form-control" required>{{ old('alamat', $klinik->alamat ?? '') }}</textarea>
    </div>

    <div class="col-md-4">
        <label class="form-label">Telepon</label>
        <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $klinik->telepon ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">Jam Buka</label>
        <input type="time" name="jam_buka" class="form-control" value="{{ old('jam_buka', $klinik->jam_buka ?? '08:00') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">Jam Tutup</label>
        <input type="time" name="jam_tutup" class="form-control" value="{{ old('jam_tutup', $klinik->jam_tutup ?? '16:00') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">Hari Buka</label>
        <input type="text" name="hari_buka" class="form-control" value="{{ old('hari_buka', $klinik->hari_buka ?? 'Senin – Jumat') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">Latitude</label>
        <input 
            type="text" 
            name="lat" 
            class="form-control placeholder-soft" 
            value="{{ old('lat', $klinik->lat ?? '') }}" 
            placeholder="-6.2441"
        >
    </div>

    <div class="col-md-4">
        <label class="form-label">Longitude</label>
        <input 
            type="text" 
            name="lng" 
            class="form-control placeholder-soft" 
            value="{{ old('lng', $klinik->lng ?? '') }}" 
            placeholder="106.7922"
        >
    </div>

    <div class="col-md-8">
        <label class="form-label">Layanan</label>
        <input type="text" name="layanan" class="form-control" value="{{ $layananValue }}" placeholder="Diagnosis TBC, Pengobatan OAT">
        <small class="text-muted">Pisahkan layanan dengan koma.</small>
    </div>

    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="aktif" @selected(old('status', $klinik->status ?? 'aktif') === 'aktif')>Aktif</option>
            <option value="nonaktif" @selected(old('status', $klinik->status ?? '') === 'nonaktif')>Nonaktif</option>
        </select>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('klinik.index') }}" class="btn btn-outline-secondary">Batal</a>
    <button type="submit" class="btn btn-primary">Simpan Klinik</button>
</div>
