@extends('master')

@section('title', 'Detail Absensi')
@section('page-title', 'Detail Data Absensi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Data Absensi</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>Informasi Karyawan</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Nama Karyawan</strong></td>
                                <td>{{ $attendance->employee->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan</strong></td>
                                <td>{{ $attendance->employee->position->nama_jabatan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Departemen</strong></td>
                                <td>{{ $attendance->employee->department->nama_departemen ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Informasi Absensi</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Tanggal</strong></td>
                                <td>{{ date('d/m/Y', strtotime($attendance->tanggal)) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Hari</strong></td>
                                <td>{{ date('l', strtotime($attendance->tanggal)) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Input</strong></td>
                                <td>{{ $attendance->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card bg-light">
                    <div class="card-header">
                        <h6 class="mb-0">Detail Kehadiran</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <small class="text-muted">Waktu Masuk</small>
                                <h5 class="{{ $attendance->waktu_masuk ? 'text-success' : 'text-muted' }}">
                                    {{ $attendance->waktu_masuk ?: '-' }}
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Waktu Keluar</small>
                                <h5 class="{{ $attendance->waktu_keluar ? 'text-info' : 'text-muted' }}">
                                    {{ $attendance->waktu_keluar ?: '-' }}
                                </h5>
                            </div>
                            <div class="col-md-4">
                                @php
                                    $statusColors = [
                                        'hadir' => 'success',
                                        'izin' => 'warning', 
                                        'sakit' => 'info',
                                        'alpha' => 'danger'
                                    ];
                                    $statusIcons = [
                                        'hadir' => 'fa-check-circle',
                                        'izin' => 'fa-clock',
                                        'sakit' => 'fa-plus-circle', 
                                        'alpha' => 'fa-times-circle'
                                    ];
                                @endphp
                                <small class="text-muted">Status</small>
                                <h4 class="text-{{ $statusColors[$attendance->status_absensi] }}">
                                    <i class="fas {{ $statusIcons[$attendance->status_absensi] }} me-2"></i>
                                    {{ ucfirst($attendance->status_absensi) }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <div>
                        <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data absensi ini?')">
                                <i class="fas fa-trash me-2"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection