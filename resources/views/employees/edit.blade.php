@extends('master')

@section('title', 'Edit Data Karyawan')
@section('page-title', 'Edit Data Karyawan')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0">
            <i class="fas fa-user-edit me-2"></i> Form Edit Karyawan
        </h5>
    </div>

    <div class="card-body">
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-user me-1 text-primary"></i> Nama Lengkap *
                    </label>
                    <input type="text" name="nama_lengkap" class="form-control"
                           value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-envelope me-1 text-primary"></i> Email *
                    </label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $employee->email) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-phone me-1 text-primary"></i> Nomor Telepon *
                    </label>
                    <input type="text" name="nomor_telepon" class="form-control"
                           value="{{ old('nomor_telepon', $employee->nomor_telepon) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-birthday-cake me-1 text-primary"></i> Tanggal Lahir *
                    </label>
                    <input type="date" name="tanggal_lahir" class="form-control"
                           value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}" required>
                </div>

                <div class="col-12">
                    <label class="form-label">
                        <i class="fas fa-map-marker-alt me-1 text-primary"></i> Alamat *
                    </label>
                    <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $employee->alamat) }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-calendar-check me-1 text-primary"></i> Tanggal Masuk *
                    </label>
                    <input type="date" name="tanggal_masuk" class="form-control"
                           value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-toggle-on me-1 text-primary"></i> Status *
                    </label>
                    <select name="status" class="form-select" required>
                        <option value="aktif" {{ $employee->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ $employee->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-building me-1 text-primary"></i> Departemen *
                    </label>
                    <select name="departemen_id" class="form-select" required>
                        @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" 
                            {{ $employee->departemen_id == $dept->id ? 'selected' : '' }}>
                            {{ $dept->nama_departemen }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="fas fa-briefcase me-1 text-primary"></i> Jabatan *
                    </label>
                    <select name="jabatan_id" class="form-select" required>
                        @foreach($positions as $pos)
                        <option value="{{ $pos->id }}" 
                            {{ $employee->jabatan_id == $pos->id ? 'selected' : '' }}>
                            {{ $pos->nama_jabatan }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
