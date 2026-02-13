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
                        <label class="form-label fw-semibold">Hasil Pemeriksaan</label>
                        <input type="date" class="form-control" name="tanggal_bap" value="2026-01-26">
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Hasil Kesimpulan dan Saran</label>
                        <input type="text" class="form-control" name="nama_penerima" value="Ibu Sulistiawati">
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
