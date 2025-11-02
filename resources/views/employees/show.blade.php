@extends('master')

@section('title', 'Detail Pegawai')
@section('page-title', 'Detail Data Pegawai')

@section('content')
<div class="card">
    <div class="card-body">

        <table class="table table-bordered">
            <tr><th>Nama Lengkap</th><td>{{ $employee->nama_lengkap }}</td></tr>
            <tr><th>Email</th><td>{{ $employee->email }}</td></tr>
            <tr><th>Nomor Telepon</th><td>{{ $employee->nomor_telepon }}</td></tr>
            <tr><th>Alamat</th><td>{{ $employee->alamat }}</td></tr>
            <tr><th>Tanggal Lahir</th><td>{{ $employee->tanggal_lahir }}</td></tr>
            <tr><th>Tanggal Masuk</th><td>{{ $employee->tanggal_masuk }}</td></tr>
            <tr><th>Departemen</th><td>{{ $employee->department->nama_departemen }}</td></tr>
            <tr><th>Jabatan</th><td>{{ $employee->position->nama_jabatan }}</td></tr>
            <tr><th>Status</th><td>{{ $employee->status }}</td></tr>
        </table>

        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
