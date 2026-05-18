@extends('layouts.admin')

@section('content')
    <section class="users-page-header">
        <div class="users-page-title">
            <span>Dashboard</span>
            <h1>{{ $pageTitle ?? 'Overview' }}</h1>
            <p>Ringkasan akun admin dan kader yang terdaftar di sistem.</p>
        </div>
    </section>

    <section class="users-table-card mb-4">
        <div class="users-table-header">
            <div>
                <h2>Statistik Pengguna</h2>
                <p>Pantau jumlah akun aktif dan pembagian role dari satu tempat.</p>
            </div>
        </div>

        <div class="row g-3 p-3">
            <div class="col-12 col-md-6 col-xl-3">
                <div class="border rounded-4 p-4 h-100 bg-white">
                    <div class="users-muted-text mb-2">Total User</div>
                    <div class="fs-2 fw-bold text-dark">{{ $stats['total_users'] ?? 0 }}</div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="border rounded-4 p-4 h-100 bg-white">
                    <div class="users-muted-text mb-2">Super Admin</div>
                    <div class="fs-2 fw-bold text-danger">{{ $stats['super_admins'] ?? 0 }}</div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="border rounded-4 p-4 h-100 bg-white">
                    <div class="users-muted-text mb-2">Kader</div>
                    <div class="fs-2 fw-bold" style="color: #003366;">{{ $stats['kaders'] ?? 0 }}</div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-3">
                <div class="border rounded-4 p-4 h-100 bg-white">
                    <div class="users-muted-text mb-2">User Aktif</div>
                    <div class="fs-2 fw-bold text-success">{{ $stats['active_users'] ?? 0 }}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="users-table-card">
        <div class="users-table-header">
            <div>
                <h2>User Terbaru</h2>
                <p>Lima akun terbaru yang masuk ke sistem.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table users-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor HP</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentUsers as $user)
                        <tr>
                            <td>
                                <div class="users-profile-cell">
                                    <span class="users-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number ?: 'Belum diisi' }}</td>
                            <td>
                                <span class="users-role-pill {{ $user->isSuperAdmin() ? 'is-admin' : 'is-kader' }}">
                                    {{ $user->roleLabel() }}
                                </span>
                            </td>
                            <td>
                                <span class="users-status-pill {{ $user->is_active ? 'is-active' : 'is-inactive' }}">
                                    <span></span>{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="users-date">{{ $user->created_at?->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada user yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
