@php
    $layananValue = old('layanan');

    if ($layananValue === null && $klinik) {
        $layananValue = implode(', ', $klinik->layanan ?? []);
    }
@endphp

<div class="row g-3">
    <div class="col-12">
        <label class="form-label">Nama Klinik</label>
        <input type="text" name="nama" class="form-control" required value="{{ old('nama', $klinik?->nama) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Tipe</label>
        <input type="text" name="tipe" class="form-control" required value="{{ old('tipe', $klinik?->tipe) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Kota</label>
        <input type="text" name="kota" class="form-control" required value="{{ old('kota', $klinik?->kota) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Provinsi</label>
        <input type="text" name="provinsi" class="form-control" required value="{{ old('provinsi', $klinik?->provinsi) }}">
    </div>
    <div class="col-12">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $klinik?->alamat) }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Telepon</label>
        <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $klinik?->telepon) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Latitude</label>
        <input type="number" step="0.0000001" name="latitude" class="form-control" required value="{{ old('latitude', $klinik?->latitude) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Longitude</label>
        <input type="number" step="0.0000001" name="longitude" class="form-control" required value="{{ old('longitude', $klinik?->longitude) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Jam Buka</label>
        <input type="time" name="jam_buka" class="form-control" value="{{ old('jam_buka', $klinik?->jam_buka) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Jam Tutup</label>
        <input type="time" name="jam_tutup" class="form-control" value="{{ old('jam_tutup', $klinik?->jam_tutup) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Hari Buka</label>
        <input type="text" name="hari_buka" class="form-control" value="{{ old('hari_buka', $klinik?->hari_buka) }}" placeholder="Senin - Jumat">
    </div>
    <div class="col-md-3">
        <label class="form-label">Hari Tutup</label>
        <input type="text" name="hari_tutup" class="form-control" value="{{ old('hari_tutup', $klinik?->hari_tutup) }}" placeholder="Sabtu, Minggu">
    </div>
    <div class="col-md-8">
        <label class="form-label">Layanan</label>
        <textarea name="layanan" class="form-control" rows="2" placeholder="Pisahkan dengan koma atau baris baru">{{ $layananValue }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="aktif" @selected(old('status', $klinik?->status ?? 'aktif') === 'aktif')>Aktif</option>
            <option value="nonaktif" @selected(old('status', $klinik?->status) === 'nonaktif')>Nonaktif</option>
        </select>
    </div>
</div>
