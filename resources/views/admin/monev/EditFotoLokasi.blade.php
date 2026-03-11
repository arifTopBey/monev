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

                <form action="{{ route('admin.monev.update.foto', $monev->id_bap) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- No Telp -->
                    <div class="mb-4">
                        <div class="">
                            <img style="height: 180px; width: 180px;" src="{{ route('showFoto.private', $monev->foto_lapangan) }}"
                                class="img-fluid rounded shadow-sm" alt="Foto Lokasi 1">
                        </div>
                        <label class="form-label fw-semibold mt-3">Foto 1</label>
                        <input type="file" class="form-control" name="foto_lapangan" >
                        @error('foto_lapangan')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- No Telp -->
                    <div class="mb-4">
                        <div class="">
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
                        <label class="form-label fw-semibold">Foto 2</label>
                        <input type="file" name="foto_lapangan2" class="form-control">
                         @error('foto_lapangan2')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- No Telp -->
                    <div class="mb-4">
                        <div class="">
                             @if ($monev->foto_lapangan3)
                                <img height="180" width="180"
                                    src="{{ route('showFoto.private', $monev->foto_lapangan3) }}"
                                    class="img-fluid rounded shadow-sm" alt="Foto Lokasi 2">
                            @else
                                <div class="p-3 bg-light border rounded text-center" style="height: 180px; width: 180px;">
                                    <small class="text-muted">Foto tidak tersedia</small>
                                </div>
                            @endif
                        </div>
                        <label class="form-label fw-semibold">Foto 3</label>
                        <input type="file" class="form-control" name="foto_lapangan3" >
                        @error('foto_lapangan3')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                     <div class="form-group mb-3">
                        <label for="telepon" class="mb-1 fw-bold">Lokasi</label>
                        <input name="location" type="text" value="{{ $monev->location }}" id="telepon" class="form-control"
                            placeholder="Masukan nomor telepon" />
                        @error('location')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-1 fw-bold">Pilih Titik Lokasi di Peta</label>
                        <div id="map" class="mb-2"></div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="latitude" class="mb-1 fw-bold">Latitude</label>
                        <input name="latitude" type="text" id="latitude" value="{{ $monev->latitude }}" class="form-control" readonly />
                         @error('latitude')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="longitude" class="mb-1 fw-bold">Longitude</label>
                        <input name="longitude" type="text" value="{{ $monev->longitude }}" id="longitude" class="form-control" readonly />
                         @error('longitude')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="radius" class="mb-1 fw-bold">Radius (Meter)</label>
                        <input name="radius" type="number" id="radius" value="{{ $monev->radius }}" class="form-control" value="100" />
                        @error('radius')
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
