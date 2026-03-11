@extends('admin.main.index')
 @section('content')
    <div class="container my-4">

        <!-- HEADER -->
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Monev
                </h5>
                <div>
                    <a href="{{ route('monev') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-list"></i> Monev List
                    </a>
                    <a href="{{ route('monev.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus"></i> Tambah Monev
                    </a>
                </div>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.monev.update.keterangan.perusahaan', $monev->id_bap) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Perusahaan</label>
                        <input type="text" class="form-control" name="nama_perusahaan" value="{{ $monev->nama_perusahaan }}">
                        @error('nama_perusahaan')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Bidang Usaha</label>
                        <input type="text" class="form-control" name="bidang_usaha" value="{{ $monev->bidang_usaha }}">
                        @error('bidang_usaha')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <input type="text" class="form-control" name="status" value="{{ $monev->status }}">
                        @error('status')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">NPWP</label>
                        <input type="text" class="form-control" name="npwp" value="{{ $monev->npwp }}">
                        @error('npwp')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- No Telp -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nama Pimpinan Perusahaan</label>
                        <input type="text" class="form-control" name="nama_pemimpin_perusahaan" value="{{ $monev->nama_pemimpin_perusahaan }}">
                        @error('nama_pemimpin_perusahaan')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nilai Investasi</label>
                        <input type="text" class="form-control" name="nilai_investasi" value="{{ $monev->nilai_investasi }}">
                        @error('nilai_investasi')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Jumlah Tenaga Kerja Asing</label>
                        <input type="number" class="form-control" name="jumlah_tenaga_kerja_asing" value="{{ $monev->jumlah_tenaga_kerja_asing }}">
                         @error('jumlah_tenaga_kerja_asing')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Jumlah Tenaga Kerja Indonesia</label>
                        <input type="number" class="form-control" name="jumlah_tenaga_kerja_indonesia" value="{{ $monev->jumlah_tenaga_kerja_indonesia }}">
                        @error('jumlah_tenaga_kerja_indonesia')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Aspek Lingkungan</label>
                        <input type="text" class="form-control" name="aspek_lingkungan" value="{{ $monev->aspek_lingkungan }}">
                        @error('aspek_lingkungan')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Kelengkapan Legalitas</label>
                        <input type="text" class="form-control" name="kelengkapan_legalitas" value="{{ $monev->kelengkapan_legalitas }}">
                         @error('kelengkapan_legalitas')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Update Monev
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
