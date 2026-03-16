 @extends('admin.main.index')
 @section('content')
     <main class="app-main">
         <!--begin::App Content Header-->
         <div class="app-content-header">
             <!--begin::Container-->
             <div class="container-fluid">
                 <!--begin::Row-->
                 <div class="row">
                     <div class="col-sm-6">
                         <h3 class="mb-0">Dashboard</h3>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-end">
                             <li class="breadcrumb-item"><a href="#">Home</a></li>
                             <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                         </ol>
                     </div>
                 </div>
                 <!--end::Row-->
             </div>
             <!--end::Container-->
         </div>

         <h5 class="text-center">Selamat Datang Di Database Monev!</h5>
         <div class="container px-3 py-2 bg-white border rounded-2">
             <div class="row">
                 <div class="col-md-12">
                     <div class="d-flex justify-content-between">
                         <p>Data Kepemilikan LKPM Kabupaten Tangerang</p>
                         <a href="" class="text-decoration-none text-primary">View Report</a>
                     </div>
                 </div>
                 <div class="col-md-12 py-5 px-3 ">
                     <div style="height: 15vh;" class="border rounded-2 px-5 py-3">
                         <div class="d-flex gap-5 align-items-center mt-3">
                             <label for="show" class="me-2">Tahun</label>
                             <select class="px-5 py-0" id="show">
                                 <option value="">2022</option>
                                 <option value="">2023</option>
                                 <option value="">2024</option>
                                 <option value="">2025</option>
                                 <option value="">2026</option>
                             </select>
                             <button class="btn btn-primary text-white fw-bold">Filter</button>
                         </div>
                     </div>
                 </div>

                 <div class="col-md-3">
                    <canvas id="piechart" class="piechart border"></canvas>
                 </div>
                 <div class="col-md-3">
                    <canvas id="piechart" class="piechart border"></canvas>
                 </div>
                 <div class="col-md-3">
                    <canvas id="piechart" class="piechart border"></canvas>
                 </div>
                 <div class="col-md-3">
                    <canvas id="piechart" class="piechart border"></canvas>
                 </div>

                 <h2 class="fw-bold mt-5">Total Data Monev Bersarkan Tahun</h2>
                 <div class="col-md-12 ">
                    <canvas id="chartHorizontal" style="min-height: 400px;"></canvas>
                 </div>

             </div>
         </div>
         <!--end::App Content-->

         <div class="container px-2">
           

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
                            <option value="10" {{ request('row_per_page') == 10 ? 'selected' : '' }}>20</option>
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
                     <form action="{{ route('dashboard') }}" method="GET">
                         <div class="d-flex">
                             <span class="mt-1 me-1">Search:</span>
                             <input type="text" name="search" class="form-control form-control-sm"
                                 placeholder="Cari nama perusahaan..." value="{{ request('search') }}">
                             <button type="submit" class="btn btn-primary btn-sm ms-2">Cari</button>
                             @if (request('search'))
                                 <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm ms-1">Reset</a>
                             @endif
                         </div>
                     </form>
                 </div>

                  <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('export.tki.tka') }}" class="btn btn-success">Export Excel</a>
                  </div>
                 <div class="col-md-12">
                     <table id="dataTable" class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Perusahaan</th>
                                <th>TKI</th>
                                <th>TKA</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                    @foreach ($data as $monev )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $monev->nama_perusahaan }}</td>
                            <td>
                                <p>{{ $monev->jumlah_tenaga_kerja_indonesia ? $monev->jumlah_tenaga_kerja_indonesia : 0 }}</p>
                            </td>
                            <td>
                                <p>{{ $monev->jumlah_tenaga_kerja_asing  ? $monev->jumlah_tenaga_kerja_indonesia : 0 }}</p>
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

           
     </main>
     <!--end::A
@endsection
