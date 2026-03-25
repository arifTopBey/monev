 @extends('admin.main.index')
 @section('content')
     <section class="">
         <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <div class="d-flex border justify-content-between py-3 px-2 mt-3 bg-white rounded-3">
                         <div class="">
                             <h4>Daftar Pengguna</h4>
                         </div>
                         <div class="d-flex gap-2">
                            <a href="{{ route('super.user.create') }}" class="btn btn-success fw-bold">+ Tambah Pengguna</a>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row mt-3 border bg-white rounded-3 py-3 px-2">

                
             </div>

             <!-- search form and pagination -->
             <div class="row mt-3 px-1 bg-white rounded-3 py-3 border">
                 @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                   <div class="d-flex mb-5 justify-content-between">
                     <div class="">
                         <label for="show" class="me-2">Show</label>
                        <select id="rowPerPage" class="w-auto px-3 py-1">
                            <option value="10" {{ request('row_per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('row_per_page') == 20 ? 'selected' : '' }}>20</option>
                            <option value="30" {{ request('row_per_page') == 30 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('row_per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                         <span class="ms-2">Entries</span>
                     </div>
                    
                     <form action="{{ route('super.user.list') }}" method="GET">
                         <div class="d-flex">
                             <span class="mt-1 me-1">Search:</span>
                             <input type="text" name="search" class="form-control form-control-sm"
                                 placeholder="Cari nama pengguna" value="{{ request('search') }}">
                             <button type="submit" class="btn btn-primary btn-sm ms-2">Cari</button>
                             @if (request('search'))
                                 <a href="{{ route('super.user.list') }}" class="btn btn-secondary btn-sm ms-1">Reset</a>
                             @endif
                         </div>
                     </form>
                 </div>
                 <div class="col-md-12">
                     <table id="dataTable" class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Pengguna</th>
                                <th>Email</th>
                                <th>Role Pengguna</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $users )
                            
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $users->firstname }} {{ $users->lastname }}</td>
                                <td>{{ $users->email }}</td>
                                <td class="d-flex justify-content-center ">
                                @if ($users->role_id ===1 )
                                    <span class="badge rounded-pill text-bg-info text-white py-2 px-2">Super Admin</span>

                                @elseif($users->role_id === 2)
                                    
                                    <span class="badge rounded-pill text-bg-success text-white py-2 px-2 mt-2">Admin</span>
                                @elseif($users->role_id === 3)
                                    
                                    <span class="badge rounded-pill text-bg-secondary text-white py-2 px-2 mt-2">Back Office Pengendalian</span>
                                @elseif($users->role_id === 4)
                                    <span class="badge rounded-pill text-bg-warning text-white py-2 px-2 mt-2">Kepala Seksi Pengendalian</span>
                                @elseif($users->role_id === 5)
                                    <span class="badge rounded-pill text-bg-danger text-white py-2 px-2 mt-2">Kepala Bidang Pengendalian</span>
                                @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('super.user.detail', $users->id) }}" class="btn btn-info">👁️</a>
                                        <form id="delete-form-{{ $users->id }}"
                                             action="{{ route('super.user.delete', $users->id) }}"
                                             method="post">
                                             @csrf
                                             @method('delete')
                                             <button
                                                onclick="confirmDelete('{{ $users->id }}', '{{ $users->username }}')"
                                                 type="button" class="btn btn-sm btn-danger">
                                                 🗑
                                             </button>
                                         </form>
                                    </div>
                                </td>
                            </tr>
                         @endforeach

                        </tbody>
                     </table>
                 </div>

             </div>

              <div class="row">
                 <div class="col-md-12 d-flex justify-content-end">
                     <div class="mt-5">
                         {{ $data->links() }}
                     </div>
                 </div>
              </div>
             <!-- batas search dan pagination -->
         </div>
     </section>
 @endsection
