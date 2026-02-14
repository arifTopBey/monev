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

                <form  action="{{ route('admin.monev.update.hasil.kesimpulan', $monev->id_bap) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Hasil Pemeriksaan</label>
                        <textarea class="form-control" name="hasil_pemeriksaan" rows="5">{{ $monev->hasil_pemeriksaan }}</textarea>
                    </div>

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Hasil Kesimpulan dan Saran</label>
                        <textarea class="form-control" name="kesimpulan_saran" rows="5">{{ $monev->kesimpulan_saran }}</textarea>
                    </div>


                    <!-- Button -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            Update Monev
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
