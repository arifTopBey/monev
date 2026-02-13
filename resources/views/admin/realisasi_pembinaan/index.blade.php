 @extends('admin.main.index')
 @section('content')
     <section class="">
         <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <div class="d-flex border justify-content-between py-3 px-2 mt-3 bg-white rounded-3">
                         <div class="">
                             <h4>Realisasi Pembinaan List</h4>
                         </div>
                         <div class="">
                             <a href="" class="btn btn-success px-3 py-1 fs-5">Eksport Excel</a>
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
                        <select class="px-5 py-0" id="show">
                            <option value="">10</option>
                            <option value="">15</option>
                            <option value="">20</option>
                            <option value="">25</option>
                            <option value="">30</option>
                        </select>
                        <span class="ms-2">Entries</span>
                    </div>
                    <div class="d-flex">
                        <span class="mt-1 me-1">Seach: </span>
                        <input type="text" class="form-control ">
                    </div>
                </div>
                 <div class="col-md-12">
                     <table id="dataTable" class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Tgl Pembinaan</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat</th>
                                <th>Agenda Pembinaan</th>
                                <th>Hasil Pembinaan</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $pembinaan )
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($pembinaan->dateCreated)->translatedFormat('j F Y') }}</td>
                                <td>{{ $pembinaan->namaPerusahaan }}</td>
                                <td>{{ $pembinaan->alamatPerusahaan }}</td>
                                <td>Pembuatan LKPM</td>
                                @if ($pembinaan->hasilPembinaan === 0)
                                    <td><P class="text-danger border border-primary px-2 py-1"><span class="fw-bold fs-5">x</span> Belum Lapor Pembuatan LKPM</P></td>
                                @else

                                <td><P class="text-success border border-primary px-2 py-1">✔ Sudah Lapor Pembuatan LKPM</P></td>
                                @endif

                            </tr>
                            @endforeach

                        </tbody>
                     </table>
                 </div>
             </div>

             
         </div>
     </section>
 @endsection
