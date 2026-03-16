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
                                 <option value="">10</option>
                                 <option value="">15</option>
                                 <option value="">20</option>
                                 <option value="">25</option>
                                 <option value="">30</option>
                             </select>
                             <button class="btn btn-primary text-white fw-bold">Filter</button>
                         </div>
                     </div>
                 </div>

                 <div class="col-md-3">
                    <canvas id="piechart" class="piechart border"></canvas>
                 </div>
             </div>
         </div>
         <!--end::App Content-->
     </main>
     <!--end::A
@endsection
