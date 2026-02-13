 @extends('admin.main.index')
 @section('content')
     <section class="">
         <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <div class="d-flex border justify-content-between py-3 px-2 mt-3 bg-white rounded-3">
                         <div class="">
                             <h4>Pembinaan List</h4>
                         </div>
                         <div class="">
                             <a href="{{ route('pembinaan.create') }}" class="btn btn-success px-3 py-1 fs-5">+ Tambah
                                 Pembinaan</a>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row mt-3 border bg-white rounded-3 py-3 px-2">

                 <div class="col-md-3">
                     <label class="form-label">Date From:</label>
                     <input type="date" class="form-control">
                 </div>
                 <div class="col-md-3">
                     <label class="form-label">Date To:</label>
                     <input type="date" class="form-control">
                 </div>
                 <div class="col-md-3 my-auto  py-3">
                     <button class="btn btn-info text-white mt-3">
                         Submit
                     </button>
                     <button class="btn btn-danger mt-3">
                         Reset
                     </button>
                 </div>

             </div>

             <div class="row mt-3 px-1 bg-white rounded-3 py-3 border">
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
                     {{-- <div class="d-flex">
                        <span class="mt-1 me-1">Seach: </span>
                        <input type="text" class="form-control ">
                    </div> --}}
                     <form action="{{ route('pembinaan') }}" method="GET">
                         <div class="d-flex">
                             <span class="mt-1 me-1">Search:</span>
                             <input type="text" name="search" class="form-control form-control-sm"
                                 placeholder="Cari nama perusahaan..." value="{{ request('search') }}">
                             <button type="submit" class="btn btn-primary btn-sm ms-2">Cari</button>
                             @if (request('search'))
                                 <a href="{{ route('pembinaan') }}" class="btn btn-secondary btn-sm ms-1">Reset</a>
                             @endif
                         </div>
                     </form>
                 </div>
                 <div class="col-md-12">
                     <table id="dataTable" class="table table-striped table-bordered">
                         <thead class="table-light">

                             <tr>
                                 <th>Tgl Pembinaan</th>
                                 <th>Nama Perusahaan</th>
                                 <th>Alamat</th>
                                 <th>Nama Peserta</th>
                                 <th>No Telp HP</th>
                                 <th>Agenda Pembinaan</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($data as $pembinaan)
                                 <tr>
                                     <td>{{ \Carbon\Carbon::parse($pembinaan->dateCreated)->translatedFormat('j F Y') }}
                                     </td>
                                     <td>{{ $pembinaan->namaPerusahaan }}</td>
                                     <td>{{ $pembinaan->alamatPerusahaan }}</td>
                                     <td>{{ $pembinaan->namaPeserta }}</td>
                                     <td>{{ $pembinaan->noTelpHp }}</td>
                                     <td>{{ $pembinaan->Agenda->namaAgenda }}</td>
                                     <td>
                                         <form id="delete-form-{{ $pembinaan->id }}"
                                             action="{{ route('admin.pembinaan.destroy', $pembinaan->id) }}"
                                             method="post">
                                             @csrf
                                             @method('delete')
                                             <button
                                                 onclick="confirmDelete('{{ $pembinaan->id }}', '{{ $pembinaan->namaPerusahaan }}')"
                                                 type="button" class="btn btn-sm btn-danger">
                                                 ✖
                                             </button>
                                         </form>

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

         </div>
     </section>
 @endsection
