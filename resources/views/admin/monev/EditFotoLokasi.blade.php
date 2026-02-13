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

                    <!-- No Telp -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Foto 1</label>
                        <input type="file" class="form-control" name="no_telp" value="085780399736">
                    </div>
                    <!-- No Telp -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Foto 2</label>
                        <input type="file" class="form-control" name="no_telp" value="085780399736">
                    </div>
                    <!-- No Telp -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Foto 3</label>
                        <input type="file" class="form-control" name="no_telp" value="085780399736">
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
