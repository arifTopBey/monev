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

                <form class="d-flex gap-2" action="{{ route('monev') }}" method="get">
                    <div class="col-md-3">
                        <label class="form-label">Date From:</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date To:</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>
                    <div class="col-md-3 my-auto  py-3">
                        <button type="sumbit" class="btn btn-info text-white mt-3">
                            Submit
                        </button>
                        <a href="{{ route('monev') }}" class="btn btn-danger mt-3">
                            Reset
                        </a>
                    </div>
                </form>
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
                    <form action="{{ route('realisasi') }}" method="GET">
                        <div class="d-flex">
                            <span class="mt-1 me-1">Search:</span>
                            <input type="text" name="search" class="form-control form-control-sm"
                                placeholder="Cari nama perusahaan..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-sm ms-2">Cari</button>
                            @if (request('search'))
                                <a href="{{ route('realisasi') }}" class="btn btn-secondary btn-sm ms-1">Reset</a>
                            @endif
                        </div>
                    </form>
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
                            @foreach ($data as $monev)
                                <tr>
                                    <td>{{ $monev->tanggal_bap }}</td>
                                    <td>{{ $monev->nama_perusahaan }}</td>
                                    <td>{{ $monev->alamat_perusahaan }}</td>
                                    <td>{{ $monev->nilai_investasi }}</td>
                                    <td>{{ $monev->jumlah_tenaga_kerja_asing + $monev->jumlah_tenaga_kerja_indonesia }}</td>
                                    <td class="w-full">LLKPL</td>
                                    <td>
                                        @if (!$monev->izinLKPM)
                                            <button data-id="{{ $monev->id_bap }}" type="button"
                                                class="btn-update-lkpm btn btn-info text-white text-nowrap">
                                                Ganti Status
                                            </button>
                                           
                                                <p class="text-center fw-bold">❌</p>
                                        @else
                                            <button data-id="{{ $monev->id_bap }}" type="button"
                                                class="btn-update-lkpm btn btn-info text-white text-nowrap">
                                                Ganti Status
                                            </button>

                                            <div id="status-icon-{{ $monev->id_bap }}" class="mt-2">
                                                {{-- Perbaikan Logika: Jika 1 maka Centang, Jika 0 maka Silang --}}
                                                @if ($monev->izinLKPM->statusLapor == 1)
                                                    <p class="text-center fw-bold">✅</p>
                                                @else
                                                    <p class="text-center fw-bold">❌</p>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        
                                        @if(!$monev->izinDimiliki)
                                        <button data-id="{{ $monev->id_bap }}" type="button"
                                        class="btn-update-pkkpr btn btn-info text-white text-nowrap">
                                        Ganti Status
                                    </button>
                                    <p class="text-center fw-bold">❌</p>

                                        @else
                                            <button data-id="{{ $monev->id_bap }}" type="button"
                                                class="btn-update-pkkpr btn btn-info text-white text-nowrap">
                                                Ganti Status
                                            </button>
                                            <div id="status-icon-pkkpr-{{ $monev->id_bap }}" class="mt-2">
                                                @if ($monev->izinDimiliki->pkkpr === 1)
                                                    <p class="text-center fw-bold">✅</p>
                                                @else
                                                    <p class="text-center fw-bold">❌</p>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info text-white text-nowrap" href="">Ganti Status</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-info text-white text-nowrap" href="">Ganti Status</a>
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