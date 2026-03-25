@extends('admin.main.index')
@section('content')
    <div class="container my-4">

        <!-- HEADER -->
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square"></i> Tambah Pengguna
                </h5>
                <div>
                    <a href="#" class="btn btn-success btn-sm">
                        <i class="bi bi-list"></i> Daftar Pengguna
                    </a>

                </div>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('super.user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Image Profile</label>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group mb-3">
                        <label for="username" class="mb-1 fw-bold">Username</label>
                        <input name="username" type="text" id="username" class="form-control"
                            placeholder="Masukan nomor username" required />
                        @error('username')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="firstname" class="mb-1 fw-bold">firstname</label>
                        <input name="firstname" placeholder="masukan nama depan" type="text" id="firstname"
                            class="form-control" required />
                        @error('firstname')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="lastname" class="mb-1 fw-bold">lastname</label>
                        <input name="lastname" placeholder="masukan nama belakang" type="text" id="lastname"
                            class="form-control" required />
                        @error('lastname')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="lokasi" class="mb-1 fw-bold">Pilih Role Pengguna</label>
                        <select name="role_id" class="form-control" id="show" required>
                            <option value="">Pilih Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->admin_role_title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="mb-1 fw-bold">email</label>
                        <input name="email" placeholder="masukan email" type="email" id="email" class="form-control"
                            required />
                        @error('email')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="mobile_no" class="mb-1 fw-bold">No Telp</label>
                        <input name="mobile_no" placeholder="masukan nomor telepon" type="text" id="mobile_no"
                            class="form-control" required />
                        @error('email')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="mb-1 fw-bold">Password</label>
                        <input name="password" type="password" id="password" class="form-control"
                            placeholder="masukan password" required />
                        @error('password')
                            <span class="fw-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Submit
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection