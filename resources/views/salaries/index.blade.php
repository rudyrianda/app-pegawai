@extends('master')

@section('title', 'Data Penggajian')
@section('page-title', 'Manajemen Penggajian')

@section('header-buttons')
    <a href="{{ route('salaries.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Data Gaji
    </a>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">{{ $salaries->total() }}</h4>
                        <p class="mb-0">Total Data Gaji</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-file-invoice-dollar fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">Rp {{ number_format($totalGaji, 0, ',', '.') }}</h4>
                        <p class="mb-0">Total Pengeluaran Gaji</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="mb-0">Rp {{ number_format($avgGaji, 0, ',', '.') }}</h4>
                        <p class="mb-0">Rata-rata Gaji</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-calculator fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Salaries Table -->
<div class="card">
    <div class="card-header bg-transparent">
        <h5 class="card-title mb-0">Daftar Penggajian</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Karyawan</th>
                        <th>Bulan</th>
                        <th>Gaji Pokok</th>
                        <th>Tunjangan</th>
                        <th>Potongan</th>
                        <th>Total Gaji</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salaries as $salary)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $salary->employee->nama_lengkap }}</strong>
                            <br>
                            <small class="text-muted">{{ $salary->employee->position->nama_jabatan ?? '-' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ date('F Y', strtotime($salary->bulan . '-01')) }}</span>
                        </td>
                        <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                        <td>
                            <strong class="text-success">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</strong>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-info" 
                                   data-bs-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning"
                                   data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            data-bs-toggle="tooltip" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data gaji ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-money-bill-wave fa-3x mb-3"></i>
                                <h5>Belum ada data penggajian</h5>
                                <p>Mulai dengan menambahkan data gaji pertama</p>
                                <a href="{{ route('salaries.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Data Gaji
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($salaries->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan {{ $salaries->firstItem() }} - {{ $salaries->lastItem() }} dari {{ $salaries->total() }} data
            </div>
            <nav>
                {{ $salaries->links() }}
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