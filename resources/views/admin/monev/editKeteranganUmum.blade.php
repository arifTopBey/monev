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

                <form action="{{ route('admin.monev.update.umum', ['id_bap' => $monev->id_bap]) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- <input type="date" class="form-control"> -->

                    <!-- Tanggal -->
                    <div class="mb-3 ">
                        <label for="tanggal_bap" class="form-label fw-semibold">Tanggal BAP</label>
                        <input type="date" class="form-control" name="tanggal_bap" id="tanggal_bap" value="{{ \Carbon\Carbon::parse($monev->tanggal_bap)->format('Y-m-d') }}">
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Penerima Monev</label>
                        <input type="text" class="form-control" name="nama_penerima" value="{{ $monev->nama_penerima }}">
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jabatan dalam Perusahaan</label>
                        <input type="text" class="form-control" name="jabatan" value="{{ $monev->jabatan }}">
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Perusahaan</label>
                        <textarea class="form-control" rows="3" name="alamat_perusahaan">{{ $monev->alamat_perusahaan }}</textarea>
                    </div>

                    <!-- No Telp -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">No Telp</label>
                        <input type="text" class="form-control" name="no_telp" value="{{ $monev->no_telp }}">
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
