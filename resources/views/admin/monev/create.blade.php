@extends('admin.main.index')
@section('content')
    <div class="">
        <div class="container">
            <div class="row mt-5 bg-white px-5 py-3">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="">
                            <p class="fs-5">+ Tambah Monev</p>
                        </div>
                        <div class="">
                            <a class="btn btn-success text-white" href="{{ route('monev') }}">Monev List</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">

                    @if ($errors->any())
    <div class="alert alert-danger shadow-sm">
        <div class="d-flex align-items-center mb-2">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong class="fs-6">Terjadi kesalahan input:</strong>
        </div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <form action="{{ route('admin.monev.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="company" class="mb-1 fw-bold">Nama Perusahaan</label>
                        <input name="nama_perusahaan" type="text" id="company" class="form-control"
                            placeholder="Masukan Nama Perusahaan" required/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="company_address" class="mb-1 fw-bold">Alamat Perusahaan</label>
                        <input name="alamat_perusahaan" type="text" id="company_address" class="form-control"
                            placeholder="Masukan Alamat Perusahaan" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="usaha" class="mb-1 fw-bold">Bidang Usaha</label>
                        <input name="bidang_usaha" type="text" id="usaha" class="form-control"
                            placeholder="Masukan Bidang Usaha Perusahaan" required/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="foto_perusahaan" class="mb-1 fw-bold">Foto 1 Wajib</label>
                        <input name="foto_lapangan" type="file" id="foto_perusahaan" class="form-control" required/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="foto_perusahaan2" class="mb-1 fw-bold">Foto 2 Optional</label>
                        <input name="foto_lapangan2" type="file" id="foto_perusahaan2" class="form-control" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="foto_perusahaan3" class="mb-1 fw-bold">Foto 3 Optional</label>
                        <input name="foto_lapangan3" type="file" id="foto_perusahaan3" class="form-control" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="telepon" class="mb-1 fw-bold">Nomor Telepon/Hp </label>
                        <input name="no_telp" type="text" id="telepon" class="form-control"
                            placeholder="Masukan nomor telepon" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="telepon" class="mb-1 fw-bold">Lokasi</label>
                        <input name="location" type="text" id="telepon" class="form-control"
                            placeholder="Masukan nomor telepon" />
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1 fw-bold">Pilih Titik Lokasi di Peta</label>
                        <div id="map" class="mb-2"></div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="latitude" class="mb-1 fw-bold">Latitude</label>
                        <input name="latitude" type="text" id="latitude" class="form-control" readonly />
                    </div>

                    <div class="form-group mb-3">
                        <label for="longitude" class="mb-1 fw-bold">Longitude</label>
                        <input name="longitude" type="text" id="longitude" class="form-control" readonly />
                    </div>

                    <div class="form-group mb-3">
                        <label for="radius" class="mb-1 fw-bold">Radius (Meter)</label>
                        <input name="radius" type="number" id="radius" class="form-control" value="100" />
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn-primary btn">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
