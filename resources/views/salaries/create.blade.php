@extends('master')

@section('title', 'Tambah Data Gaji')
@section('page-title', 'Tambah Data Penggajian')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Form Tambah Data Gaji</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('salaries.store') }}" method="POST">
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
                            <label for="bulan" class="form-label">Bulan <span class="text-danger">*</span></label>
                            <input type="month" class="form-control @error('bulan') is-invalid @enderror" 
                                   id="bulan" name="bulan" value="{{ old('bulan') }}" required>
                            @error('bulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="gaji_pokok" class="form-label">Gaji Pokok <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" 
                                       id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok') }}" 
                                       min="0" step="1000" required>
                            </div>
                            @error('gaji_pokok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tunjangan" class="form-label">Tunjangan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('tunjangan') is-invalid @enderror" 
                                       id="tunjangan" name="tunjangan" value="{{ old('tunjangan', 0) }}" 
                                       min="0" step="1000" required>
                            </div>
                            @error('tunjangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="potongan" class="form-label">Potongan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('potongan') is-invalid @enderror" 
                                       id="potongan" name="potongan" value="{{ old('potongan', 0) }}" 
                                       min="0" step="1000" required>
                            </div>
                            @error('potongan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title">Preview Perhitungan</h6>
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <small class="text-muted">Gaji Pokok</small>
                                        <div id="preview-gaji-pokok">Rp 0</div>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted">Tunjangan</small>
                                        <div id="preview-tunjangan">Rp 0</div>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted">Potongan</small>
                                        <div id="preview-potongan">Rp 0</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <small class="text-muted">TOTAL GAJI</small>
                                    <h4 id="preview-total-gaji" class="text-success">Rp 0</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">
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

@section('scripts')
<script>
    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updatePreview() {
        const gajiPokok = parseInt(document.getElementById('gaji_pokok').value) || 0;
        const tunjangan = parseInt(document.getElementById('tunjangan').value) || 0;
        const potongan = parseInt(document.getElementById('potongan').value) || 0;
        const totalGaji = gajiPokok + tunjangan - potongan;

        document.getElementById('preview-gaji-pokok').textContent = formatRupiah(gajiPokok);
        document.getElementById('preview-tunjangan').textContent = formatRupiah(tunjangan);
        document.getElementById('preview-potongan').textContent = formatRupiah(potongan);
        document.getElementById('preview-total-gaji').textContent = formatRupiah(totalGaji);
    }

    // Update preview when input values change
    document.getElementById('gaji_pokok').addEventListener('input', updatePreview);
    document.getElementById('tunjangan').addEventListener('input', updatePreview);
    document.getElementById('potongan').addEventListener('input', updatePreview);

    // Initial preview
    updatePreview();
</script>
@endsection