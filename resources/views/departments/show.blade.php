@extends('master')

@section('title', 'Detail Departemen')
@section('page-title', 'Detail Data Departemen')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-building me-2 text-primary"></i>
                    Detail Departemen: {{ $department->nama_departemen }}
                </h5>
            </div>
            <div class="card-body">
                <!-- Informasi Departemen -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="fas fa-info-circle me-2 text-primary"></i>
                                    Informasi Departemen
                                </h6>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td width="40%"><strong>Nama Departemen</strong></td>
                                        <td>{{ $department->nama_departemen }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jumlah Karyawan</strong></td>
                                        <td>
                                            <span class="badge bg-primary fs-6">
                                                {{ $department->employees->count() }} orang
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Dibuat</strong></td>
                                        <td>{{ $department->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Karyawan -->
                <div class="mb-4">
                    <h6 class="mb-3">
                        <i class="fas fa-users me-2 text-primary"></i>
                        Daftar Karyawan di Departemen Ini
                        <span class="badge bg-secondary">{{ $department->employees->count() }} orang</span>
                    </h6>
                    
                    @if($department->employees->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Status</th>
                                    <th>Tanggal Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($department->employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $employee->nama_lengkap }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $employee->position->nama_jabatan ?? '-' }}</span>
                                    </td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->nomor_telepon }}</td>
                                    <td>
                                        <span class="badge bg-{{ $employee->status == 'aktif' ? 'success' : 'danger' }}">
                                            {{ ucfirst($employee->status) }}
                                        </span>
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($employee->tanggal_masuk)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Belum ada karyawan dalam departemen ini.
                    </div>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection