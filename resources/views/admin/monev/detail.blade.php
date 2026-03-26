@extends('admin.main.index')
@section('content')
    <div class="">
        <div class="container my-4">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Monev BAP {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</h4>
                <div>
                    <a href="{{ route('monev') }}" class="btn btn-success btn-sm">+ Money List</a>
                    <a href="{{ route('monev.create') }}" class="btn btn-primary btn-sm">+ Tambah Money Singkat</a>
                </div>
            </div>

            <!-- I. KETERANGAN UMUM -->
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>I. Keterangan Umum</strong>
                    <a href="{{ route('admin.monev.umum', ['id_bap' => $monev->id_bap]) }}"
                        class="btn btn-warning btn-sm">Edit</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <tr>
                                <th width="30%">Nama Penerima Tim Monev</th>
                                <td>{{ $monev->nama_penerima }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan Dalam Perusahaan</th>
                                <td>{{ $monev->jabatan }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Perusahaan</th>
                                <td>{{ $monev->alamat_perusahaan }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon & Handphone</th>
                                <td>{{ $monev->no_telp }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- II. KETERANGAN PERUSAHAAN -->
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>II. Keterangan Perusahaan</strong>
                    <a href="{{ route('admin.monev.perusahaan', ['id_bap' => $monev->id_bap]) }}"
                        class="btn btn-warning btn-sm">Edit</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <tr>
                                <th width="30%">Nama Perusahaan</th>
                                <td>{{ strtoupper($monev->nama_perusahaan) }}</td>
                            </tr>
                            <tr>
                                <th>Bidang Usaha</th>
                                <td>{{ $monev->bidang_usaha }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span class="badge bg-primary">{{ $monev->status }}</span></td>
                            </tr>
                            <tr>
                                <th>NPWP</th>
                                <td>{{ $monev->npwp }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pimpinan Perusahaan</th>
                                <td>{{ $monev->nama_pemimpin_perusahaan }}</td>
                            </tr>
                            <tr>
                                <th>Nilai Investasi</th>
                                <td>
                                     Rp {{ $monev->nilai_investasi ? number_format((float) $monev->nilai_investasi, 0, ',', '.') : '0' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Tenaga Kerja Asing</th>
                                <td>{{ $monev->jumlah_tenaga_kerja_asing }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Tenaga Kerja Indonesia</th>
                                <td>{{ $monev->jumlah_tenaga_kerja_indonesia }}</td>
                            </tr>
                            <tr>
                                <th>Aspek Lingkungan</th>
                                <td><span class="badge bg-success">{{ $monev->aspek_lingkungan }}</span></td>
                            </tr>
                            <tr>
                                <th>Kelengkapan Legalitas</th>
                                <td><span class="badge bg-success">{{ $monev->kelengkapan_legalitas }}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- III. HASIL & KESIMPULAN -->
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>III. Hasil & Kesimpulan</strong>
                    <a href="{{ route('admin.monev.kesimpulan', ['id_bap' => $monev->id_bap]) }}"
                        class="btn btn-warning btn-sm">Edit</a>
                </div>
                <div class="card-body">
                    <p><strong>Hasil Pemeriksaan:</strong><br>
                        {{ $monev->hasil_pemeriksaan }}
                    </p>

                    <p><strong>Kesimpulan dan Saran:</strong><br>
                        {{ $monev->kesimpulan_saran }}
                    </p>
                </div>
            </div>

            <!-- IV. FOTO LOKASI -->
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>IV. Foto Lokasi</strong>
                    <a href="{{ route('admin.monev.edit.foto', $monev->id_bap) }}" class="btn btn-warning btn-sm">Edit</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if ($monev->foto_lapangan)
                        <div class="col-md-6 mb-3">
                            <img style="height: 180px; width: 180px;" src="{{ route('showFoto.private',  $monev->foto_lapangan) }}"
                                class="img-fluid rounded shadow-sm" alt="Foto Lokasi 1">
                        </div>
                        @else
                        <div class="p-3 bg-light border rounded text-center" style="height: 180px; width: 180px;">
                             <small class="text-muted">Foto tidak tersedia</small>
                        </div>
                        @endif
    
                        <div class="col-md-6 mb-3">
                            @if ($monev->foto_lapangan2)
                                <img height="180" width="180"
                                    src="{{ route('showFoto.private', $monev->foto_lapangan2) }}"
                                    class="img-fluid rounded shadow-sm" alt="Foto Lokasi 2">
                            @else
                                <div class="p-3 bg-light border rounded text-center" style="height: 180px; width: 180px;">
                                    <small class="text-muted">Foto tidak tersedia</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
