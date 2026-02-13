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
                                <th>Tgl Monev</th>
                                <th>Nama Perusahaan</th>
                                <th>Alamat</th>
                                <th>Jumlah Investasi</th>
                                <th>Jumlah Tenaga Kerja</th>
                                <th>Izin Dimiliki</th>
                                <th>LKPM</th>
                                <th>Izin Lokasi/PPKPR</th>
                                <th>Izin Lingkungan</th>
                                <th>Izin/Sertifikat Standart</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>7-10-2022</td>
                                <td>PT. INDONESIA FABRICATOR RAYA</td>
                                <td>Kawasan Graha Balaraja Industrial Estate, Tangerang</td>
                                <td>100.000.000</td>
                                <td>200</td>
                                <td class="w-full">LLKPL</td>
                                <td>
                                    <a class="btn btn-info text-white text-nowrap " href="">Ganti Status</a>
                                </td>
                                <td>
                                    <a class="btn btn-info text-white text-nowrap" href="">Ganti Status</a>
                                </td>
                                <td>
                                    <a class="btn btn-info text-white text-nowrap" href="">Ganti Status</a>
                                </td>
                                <td>
                                    <a class="btn btn-info text-white text-nowrap" href="">Ganti Status</a>
                                </td>
                            </tr>

                        </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </section>
 @endsection
