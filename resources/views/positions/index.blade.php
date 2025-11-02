@extends('master')

@section('title', 'Data Jabatan')
@section('page-title', 'Manajemen Jabatan')

@section('header-buttons')
    <a href="{{ route('positions.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Jabatan
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-transparent">
        <h5 class="card-title mb-0">Daftar Jabatan</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Jabatan</th>
                        <th>Gaji Pokok</th>
                        <th>Jumlah Karyawan</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($positions as $position)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong class="text-primary">{{ $position->nama_jabatan }}</strong>
                        </td>
                        <td>
                            <span class="fw-bold text-success">Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $position->employees_count }} orang</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('positions.show', $position->id) }}" class="btn btn-info" 
                                   data-bs-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning"
                                   data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            data-bs-toggle="tooltip" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-briefcase fa-3x mb-3"></i>
                                <h5>Belum ada data jabatan</h5>
                                <p>Mulai dengan menambahkan jabatan pertama</p>
                                <a href="{{ route('positions.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Tambah Jabatan
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
     
        <!-- Pagination -->
        @if($positions->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $positions->links() }}
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
