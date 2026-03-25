@extends('admin.main.index')
 @section('content')
 <div class="">
    <div class="container">
        <div class="row mt-5 bg-white px-5 py-3">
            <div class="col-md-12">
                <div class="d-flex justify-content-between mb-3">
                    <div class="">
                        <p class="fs-5">+ Tambah Pembinaan</p>
                    </div>
                    <div class="">
                        <a class="btn btn-success text-white" href="{{ route('pembinaan') }}">Pembinaan List</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <form action="{{ route('admin.pembinaan.store') }}" method="post">
                    @csrf

                     {{-- 'namaPerusahaan' => 'required|string|max:255',
            'alamatPerusahaan' => 'required|string|max:1000',
            'noTelpHp' => 'required|string|max:255',
            'namaPeserta' => 'required|string|max:255',
            'agendaPembinaanId' => 'required|exists:ci_pembinaan_id,id',
            'tglPembinaan' => 'required|date', --}}
                    <div class="form-group mb-3">
                        <label for="company" class="mb-1 fw-bold">Nama Perusahaan</label>
                        <input name="namaPerusahaan" type="text" id="company" class="form-control"
                                    placeholder="Masukan Nama Perusahaan" required />
                    </div>
                    <div class="form-group mb-3">
                        <label for="company_address" class="mb-1 fw-bold">Alamat Perusahaan</label>
                        <input name="alamatPerusahaan" type="text" id="company_address" class="form-control"
                                    placeholder="Masukan Alamat Perusahaan" required/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="usaha" class="mb-1 fw-bold">Nama Peserta</label>
                        <input name="namaPeserta" type="text" id="usaha" class="form-control"
                                    placeholder="Masukan Nama Peserta" required/>
                    </div>

                    <div class="form-group mb-3">
                        <label for="telepon" class="mb-1 fw-bold">Nomor Telepon/Hp </label>
                        <input name="noTelpHp" type="text" id="telepon" class="form-control"
                            placeholder="Masukan nomor telepon" required/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="telepon" class="mb-1 fw-bold">Tanggal Pembinaan </label>
                        <input name="tglPembinaan" type="date" id="telepon" class="form-control"
                            placeholder="Masukan nomor telepon" required/>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lokasi" class="mb-1 fw-bold">Agenda Pembinaan</label>
                        <select name="agendaPembinaanId" class="form-control" id="show" required>
                            <option value="">Pilih Agenda Pembinaan</option>
                            @foreach ($agenda as $agen )
                                <option value="{{ $agen->id }}">{{ $agen->namaAgenda }}</option>
                            @endforeach
                            </select>
                    </div>
                <div class="form-group mb-3 d-flex justify-content-end">
                    <button type="submit" class="btn-primary btn">Save Pembinaan</button>
                </div>
             </form>
            </div>
        </div>
    </div>
 </div>
 @endsection
