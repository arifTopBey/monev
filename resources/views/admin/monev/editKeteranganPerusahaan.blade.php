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
                    <a href="#" class="btn btn-success btn-sm">
                        <i class="bi bi-list"></i> Monev List
                    </a>
                    <a href="#" class="btn btn-success btn-sm">
                        <i class="bi bi-plus"></i> Tambah Monev
                    </a>
                </div>
            </div>

            <div class="card-body">

                <form action="#" method="POST">

                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Perusahaan</label>
                        <input type="date" class="form-control" name="tanggal_bap" value="2026-01-26">
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Bidang Usaha</label>
                        <input type="text" class="form-control" name="nama_penerima" value="Ibu Sulistiawati">
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <input type="text" class="form-control" name="jabatan" value="Staff">
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">NPWP</label>
                        <textarea class="form-control" rows="3" name="alamat">Jl. Raya Otonom Cikupa No.46, Talagasari, Kec. Cikupa, Kabupaten Tangerang, Banten 15710</textarea>
                    </div>

                    <!-- No Telp -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nama Pimpinan Perusahaan</label>
                        <input type="text" class="form-control" name="no_telp" value="085780399736">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nilai Investasi</label>
                        <input type="text" class="form-control" name="no_telp" value="085780399736">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Jumlah Tenaga Kerja Asing</label>
                        <input type="text" class="form-control" name="no_telp" value="085780399736">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Jumlah Tenaga Kerja Indonesia</label>
                        <input type="text" class="form-control" name="no_telp" value="085780399736">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Aspek Lingkungan</label>
                        <input type="text" class="form-control" name="no_telp" value="085780399736">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Kelengkapan Legalitas</label>
                        <input type="text" class="form-control" name="no_telp" value="085780399736">
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
