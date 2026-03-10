 @extends('admin.main.index')
 @section('content')
     <section class="">
         <div class="container bg-white px-3 py-5 ">
             <div class="row">
                 <div class="col-md-6 mb-3">
                    <div class="d-flex gap-3">
                        <i class="bi bi-pencil-square fw-bold fs-1"></i>
                        <h3 class="my-auto">Edit Password</h3>
                    </div>
                 </div>
                 <div class="col-md-6 d-flex justify-content-end mb-3">
                    <a href="{{ route('admin.auth.profile', auth()->user()->id) }}" class="btn btn-info text-white fw-bold my-auto"><i class="bi bi-arrow-left-circle-fill me-2 fs-5 text-white"></i>Kembali</a>
                 </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                 <form action="{{ route('admin.auth.update.password', auth()->user()->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-2 px-3 py-3">
                        <div style="height: 200px; width: 200px;" class="border rounded-2 bg-secondary bg-opacity-10 shadow d-flex justify-content-center align-items-center">
                            <i style="font-size: 80px;" class="bi bi-key-fill  fw-bold"></i>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="mb-3 ms-5">
                            <label for="exampleFormControlInput1" class="form-label fw-semibold">New Password</label>
                            <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Masukan Password Baru" required>
                        </div>
                        <div class="mb-3 ms-5">
                            <label for="exampleFormControlInput1" class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="exampleFormControlInput1" placeholder="Konfirmasi Password" required>
                        </div>
                        <div class="mb-3 ms-5 d-flex justify-content-end mt-5">
                            <button type="submit" class="btn btn-success px-3 py-2">Update</button>
                        </div>
                    </div>
                    </div>
                    
                </form>
             </div>
         </div>
     </section>
 @endsection
