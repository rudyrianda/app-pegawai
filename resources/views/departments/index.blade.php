@extends('master')

@section('title', 'Data Departemen')
@section('page-title', 'Manajemen Departemen')

@section('header-buttons')
    <a href="{{ route('departments.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Departemen
    </a>
@endsection

@section('content')
<div class="row">
    @foreach($departments as $department)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <h5 class="card-title text-primary">{{ $department->nama_departemen }}</h5>
        <span class="badge bg-info">{{ $department->employees_count }} Karyawan</span>
    </div>
    <p class="card-text text-muted small">Unit organisasi perusahaan</p>
    
    {{-- Progress bar dihapus --}}
    {{-- 
    <div class="mt-3">
        <div class="progress" style="height: 6px;">
            <div class="progress-bar bg-primary" style="width: {{ min($department->employees_count * 10, 100) }}%"></div>
        </div>
    </div>
    --}}
</div>

            <div class="card-footer bg-transparent border-top-0">
                <div class="btn-group w-100" role="group">
                    <a href="{{ route('departments.show', $department->id) }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-eye me-1"></i>Detail
                    </a>
                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                                onclick="return confirm('Apakah Anda yakin ingin menghapus departemen ini?')">
                            <i class="fas fa-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($departments->isEmpty())
<div class="text-center py-5">
    <div class="text-muted">
        <i class="fas fa-building fa-4x mb-3"></i>
        <h4>Belum ada data departemen</h4>
        <p class="mb-4">Mulai dengan membuat departemen pertama</p>
        <a href="{{ route('departments.create') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus me-2"></i>Tambah Departemen
        </a>
    </div>
</div>
@endif

<!-- Pagination -->
@if($departments->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $departments->links() }}
</div>
@endif
@endsection