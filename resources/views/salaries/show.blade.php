@extends('master')

@section('title', 'Detail Gaji')
@section('page-title', 'Detail Data Penggajian')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Data Gaji</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>Informasi Karyawan</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Nama Karyawan</strong></td>
                                <td>{{ $salary->employee->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan</strong></td>
                                <td>{{ $salary->employee->position->nama_jabatan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Departemen</strong></td>
                                <td>{{ $salary->employee->department->nama_departemen ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Informasi Gaji</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Bulan</strong></td>
                                <td>{{ date('F Y', strtotime($salary->bulan . '-01')) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Input</strong></td>
                                <td>{{ $salary->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card bg-light">
                    <div class="card-header">
                        <h6 class="mb-0">Rincian Gaji</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <small class="text-muted">Gaji Pokok</small>
                                <h5 class="text-primary">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</h5>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Tunjangan</small>
                                <h5 class="text-success">+ Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</h5>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Potongan</small>
                                <h5 class="text-danger">- Rp {{ number_format($salary->potongan, 0, ',', '.') }}</h5>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Total Gaji</small>
                                <h4 class="text-success">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('salaries.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <div>
                        <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data gaji ini?')">
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