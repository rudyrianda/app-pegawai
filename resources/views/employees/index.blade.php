@extends('master')

@section('title', 'Data Karyawan')
@section('page-title', 'Manajemen Karyawan')

@section('header-buttons')
    <a href="{{ route('employees.create') }}" class="btn btn-primary">
        <i class="fas fa-user-plus me-2"></i>Tambah Karyawan
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-transparent">
        <h5 class="card-title mb-0">Daftar Karyawan</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $employee->nama_lengkap }}</strong>
                        </td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->nomor_telepon }}</td>
                        <td>{{ date('d/m/Y', strtotime($employee->tanggal_masuk)) }}</td>
                        <td>
                            <span class="badge bg-{{ $employee->status == 'aktif' ? 'success' : 'danger' }}">
                                <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                                {{ ucfirst($employee->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-info" 
                                   data-bs-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning"
                                   data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            data-bs-toggle="tooltip" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-users fa-3x mb-3"></i>
                                <h5>Belum ada data karyawan</h5>
                                <p>Mulai dengan menambahkan karyawan pertama</p>
                                <a href="{{ route('employees.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Karyawan
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endsection