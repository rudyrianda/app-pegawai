@extends('master')

@section('title', 'Tambah Absensi')
@section('page-title', 'Tambah Data Absensi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Form Tambah Absensi</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('attendances.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="karyawan_id" class="form-label">Karyawan <span class="text-danger">*</span></label>
                            <select class="form-select @error('karyawan_id') is-invalid @enderror" 
                                    id="karyawan_id" name="karyawan_id" required>
                                <option value="">Pilih Karyawan</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->nama_lengkap }} - {{ $employee->position->nama_jabatan ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('karyawan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                   id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                            <input type="time" class="form-control @error('waktu_masuk') is-invalid @enderror" 
                                   id="waktu_masuk" name="waktu_masuk" value="{{ old('waktu_masuk') }}">
                            @error('waktu_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                            <input type="time" class="form-control @error('waktu_keluar') is-invalid @enderror" 
                                   id="waktu_keluar" name="waktu_keluar" value="{{ old('waktu_keluar') }}">
                            @error('waktu_keluar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Absensi <span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check card bg-success text-white p-3">
                                    <input class="form-check-input" type="radio" name="status_absensi" 
                                           id="status_hadir" value="hadir" {{ old('status_absensi') == 'hadir' ? 'checked' : '' }} required>
                                    <label class="form-check-label fw-bold" for="status_hadir">
                                        <i class="fas fa-check-circle me-2"></i>Hadir
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check card bg-warning text-white p-3">
                                    <input class="form-check-input" type="radio" name="status_absensi" 
                                           id="status_izin" value="izin" {{ old('status_absensi') == 'izin' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="status_izin">
                                        <i class="fas fa-clock me-2"></i>Izin
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check card bg-info text-white p-3">
                                    <input class="form-check-input" type="radio" name="status_absensi" 
                                           id="status_sakit" value="sakit" {{ old('status_absensi') == 'sakit' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="status_sakit">
                                        <i class="fas fa-plus-circle me-2"></i>Sakit
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check card bg-danger text-white p-3">
                                    <input class="form-check-input" type="radio" name="status_absensi" 
                                           id="status_alpha" value="alpha" {{ old('status_absensi') == 'alpha' ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="status_alpha">
                                        <i class="fas fa-times-circle me-2"></i>Alpha
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('status_absensi')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection