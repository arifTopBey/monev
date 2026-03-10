@extends('admin.main.index')
@section('content')
    <section class="">
        <div class="container bg-white px-3 py-5 ">
            <div class="row">

                @if(session('failed'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif

                <div class="col-md-6 mb-3">
                    <div class="d-flex gap-3">
                        <i class="bi bi-pencil-square fw-bold fs-1"></i>
                        <h3 class="my-auto">Edit Profile</h3>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end mb-3">
                    <a href="{{ route('admin.auth.edit.password', auth()->user()->id) }}"
                        class="btn btn-info text-white fw-bold my-auto"><i class="bi bi-key-fill me-2 fs-5 text-white"></i>
                        Ubah Password</a>
                </div>
                <form action="{{ route('admin.auth.profile.update', auth()->user()->id) }}" class="d-inline" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        
                            <div class="col-md-2 px-3 py-3">
                                <div style="height: 200px; width: 200px;"
                                    class="border rounded-2 bg-secondary bg-opacity-10 shadow d-flex justify-content-center align-items-center">
                                    <i style="font-size: 80px;" class="bi bi-person-square  fw-bold"></i>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3 ms-5">
                                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Username</label>
                                    <input type="text" value="{{ $user->username }}" name="username" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Masukan username" required>
                                     @error('username')
                                        <span class="fw-bold mt-2">{{ $message }}</span>
                                     @enderror
                                </div>
                                <div class="mb-3 ms-5">
                                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Firtsname</label>
                                    <input type="text" value="{{ $user->firstname }}" name="firstname" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Masukan username" required>
                                    @error('firstname')
                                        <span class="fw-bold mt-2">{{ $message }}</span>
                                     @enderror
                                </div>
                                <div class="mb-3 ms-5">
                                    <label for="exampleFormControlInput1" class="form-label fw-semibold">LastName</label>
                                    <input type="text" value="{{ $user->lastname }}" name="lastname" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Masukan username" required>
                                     @error('firstname')
                                        <span class="fw-bold mt-2">{{ $message }}</span>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-md-2 px-3 py-3">
                                <div style="height: 200px; width: 200px;"
                                    class="border rounded-2 bg-secondary bg-opacity-10 shadow d-flex justify-content-center align-items-center">
                                    <i style="font-size: 80px;" class="bi bi-envelope-at-fill  fw-bold"></i>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3 ms-5">
                                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Email</label>
                                    <input type="email" value="{{ $user->email }}" name="email" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Masukan Email" required>
                                     @error('email')
                                        <span class="fw-bold mt-2">{{ $message }}</span>
                                     @enderror
                                </div>
                                <div class="mb-3 ms-5">
                                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Phone number</label>
                                    <input type="text" name="mobile_no" value="{{ $user->mobile_no }}" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Masukan username" required>
                                         @error('mobile_no')
                                            <span class="fw-bold mt-2">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mb-3 ms-5 d-flex justify-content-end mt-5">
                                    <button class="btn btn-success px-3 py-2">Update</button>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection