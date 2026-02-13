@extends('admin.main.index')
 @section('content')
 <div class="">
    <div class="container my-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Monev BAP Senin, 26 Januari 2026</h4>
        <div>
            <button class="btn btn-success btn-sm">+ Money List</button>
            <button class="btn btn-primary btn-sm">+ Tambah Money Singkat</button>
        </div>
    </div>

    <!-- I. KETERANGAN UMUM -->
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>I. Keterangan Umum</strong>
            <button class="btn btn-warning btn-sm">Edit</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <tr>
                        <th width="30%">Nama Penerima Tim Monev</th>
                        <td>Ibu Sulistiawati</td>
                    </tr>
                    <tr>
                        <th>Jabatan Dalam Perusahaan</th>
                        <td>Staff</td>
                    </tr>
                    <tr>
                        <th>Alamat Perusahaan</th>
                        <td>Jl. Raya Otonom Cikupa No.46, Talagasari, Kec. Cikupa, Kabupaten Tangerang, Banten 15710</td>
                    </tr>
                    <tr>
                        <th>Nomor Telepon & Handphone</th>
                        <td>085780399736</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- II. KETERANGAN PERUSAHAAN -->
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>II. Keterangan Perusahaan</strong>
            <button class="btn btn-warning btn-sm">Edit</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <tr>
                        <th width="30%">Nama Perusahaan</th>
                        <td>PT. TRIMITRA SWADAYA</td>
                    </tr>
                    <tr>
                        <th>Bidang Usaha</th>
                        <td>Industri Barang Plastik Lembaran</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><span class="badge bg-primary">PMDN</span></td>
                    </tr>
                    <tr>
                        <th>NPWP</th>
                        <td>00.199.275.4-002.7000</td>
                    </tr>
                    <tr>
                        <th>Nama Pimpinan Perusahaan</th>
                        <td>THONG ERNA</td>
                    </tr>
                    <tr>
                        <th>Nilai Investasi</th>
                        <td>Rp 10.242.000.000</td>
                    </tr>
                    <tr>
                        <th>Jumlah Tenaga Kerja Asing</th>
                        <td>0</td>
                    </tr>
                    <tr>
                        <th>Jumlah Tenaga Kerja Indonesia</th>
                        <td>87</td>
                    </tr>
                    <tr>
                        <th>Aspek Lingkungan</th>
                        <td><span class="badge bg-success">Ada</span></td>
                    </tr>
                    <tr>
                        <th>Kelengkapan Legalitas</th>
                        <td><span class="badge bg-success">Ada</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- III. HASIL & KESIMPULAN -->
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>III. Hasil & Kesimpulan</strong>
            <button class="btn btn-warning btn-sm">Edit</button>
        </div>
        <div class="card-body">
            <p><strong>Hasil Pemeriksaan:</strong><br>
            PT. Care Spunbond saat ini sudah merger dengan PT. Trimitra Swadaya sehingga NIB dan Perizinan menjadi atas nama PT. Trimitra Swadaya sebagai entitas terbaru sudah melaporkan LKPM Triwulan 4.
            </p>

            <p><strong>Kesimpulan dan Saran:</strong><br>
            Melakukan pembaharuan dan mencetak NIB terupdate yang sudah ada di lokasi PT di Kabupaten Tangerang.
            </p>
        </div>
    </div>

    <!-- IV. FOTO LOKASI -->
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>IV. Foto Lokasi</strong>
            <button class="btn btn-warning btn-sm">Edit</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <img src="https://via.placeholder.com/600x400" class="img-fluid rounded shadow-sm" alt="Foto Lokasi 1">
                </div>
                <div class="col-md-6 mb-3">
                    <img src="https://via.placeholder.com/600x400" class="img-fluid rounded shadow-sm" alt="Foto Lokasi 2">
                </div>
            </div>
        </div>
    </div>
 </div>
 @endsection
