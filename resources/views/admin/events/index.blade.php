@extends('layouts.admin')

@section('content')
<div class="admin-card">
    <h1>Moderasi Event</h1>
    @if(session('status')) <div class="alert alert-success">{{ session('status') }}</div> @endif
    <table class="admin-table">
        <thead><tr><th>Event</th><th>Kader</th><th>Tanggal/Lokasi</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->judul }}<br><small>{{ $event->deskripsi }}</small></td>
                <td>{{ $event->kader?->nama }}</td>
                <td>{{ $event->tanggal_pelaksanaan?->format('d M Y') }}<br><small>{{ $event->lokasi_alamat }}</small></td>
                <td>{{ $event->status }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.events.review', $event) }}" style="display:grid;gap:8px;min-width:220px">
                        @csrf @method('PATCH')
                        <select name="status" required>
                            <option value="disetujui">Setujui</option>
                            <option value="ditolak">Tolak</option>
                        </select>
                        <textarea name="catatan_admin" placeholder="Catatan admin"></textarea>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $events->links() }}
</div>
@endsection
