@extends('master')

@section('title', 'Data Absensi')
@section('page-title', 'Manajemen Absensi')

@section('header-buttons')
    <a href="{{ route('attendances.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Absensi
    </a>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $stats['hadir'] }}</h4>
                        <p class="mb-0">Hadir Hari Ini</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-check fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $stats['izin'] }}</h4>
                        <p class="mb-0">Izin Hari Ini</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $stats['sakit'] }}</h4>
                        <p class="mb-0">Sakit Hari Ini</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-injured fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $stats['alpha'] }}</h4>
                        <p class="mb-0">Alpha Hari Ini</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-times fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Attendances Table -->
<div class="card">
    <div class="card-header bg-transparent">
        <h5 class="card-title mb-0">Daftar Absensi</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Karyawan</th>
                        <th>Tanggal</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                    <tr>
                        <td>{{ $loop->iteration + ($attendances->currentPage() - 1) * $attendances->perPage() }}</td>
                        <td>
                            <strong>{{ $attendance->employee->nama_lengkap }}</strong>
                            <br>
                            <small class="text-muted">{{ $attendance->employee->position->nama_jabatan ?? '-' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ date('d/m/Y', strtotime($attendance->tanggal)) }}</span>
                        </td>
                        <td>
                            @if($attendance->waktu_masuk)
                                <span class="badge bg-success">{{ $attendance->waktu_masuk }}</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td>
                            @if($attendance->waktu_keluar)
                                <span class="badge bg-info">{{ $attendance->waktu_keluar }}</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $statusColors = [
                                    'hadir' => 'success',
                                    'izin' => 'warning', 
                                    'sakit' => 'info',
                                    'alpha' => 'danger'
                                ];
                            @endphp
                            <span class="badge bg-{{ $statusColors[$attendance->status_absensi] }}">
                                <i class="fas 
                                    @if($attendance->status_absensi == 'hadir') fa-check-circle 
                                    @elseif($attendance->status_absensi == 'izin') fa-clock
                                    @elseif($attendance->status_absensi == 'sakit') fa-plus-circle
                                    @else fa-times-circle @endif
                                    me-1">
                                </i>
                                {{ ucfirst($attendance->status_absensi) }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('attendances.show', $attendance->id) }}" class="btn btn-info" 
                                   data-bs-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-warning"
                                   data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            data-bs-toggle="tooltip" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data absensi ini?')">
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
                                <i class="fas fa-calendar-check fa-3x mb-3"></i>
                                <h5>Belum ada data absensi</h5>
                                <p>Mulai dengan menambahkan data absensi pertama</p>
                                <a href="{{ route('attendances.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Absensi
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($attendances->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan {{ $attendances->firstItem() }} - {{ $attendances->lastItem() }} dari {{ $attendances->total() }} data
            </div>
            <nav>
                {{ $attendances->links() }}
            </nav>
        </div>
        @endif
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