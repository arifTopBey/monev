<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\MonevApiStoreRequest;
use App\Http\Requests\api\MonevUpdateFotoApiRequest;
use App\Http\Requests\api\UpdateKesimpulanRequest;
use App\Http\Requests\api\UpdateKeteranganPerusahaanRequest;
use App\Http\Requests\api\UpdateMonevUmumRequest;
use App\Interface\MonevInterface;
use App\Models\Monev;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Exports\MonevExport;
use App\Exports\PembinaanExport;
use App\Exports\TkiTkaExport;
use Maatwebsite\Excel\Facades\Excel;

class MonevController extends Controller
{

    private MonevInterface $monevInterface;


    public function __construct(MonevInterface $monevInterface){
        $this->monevInterface = $monevInterface;
    }

    public function index(Request $request){

        $search = $request->input('search');

         // Tangkap input dari form Blade
        $perPage = $request->input('row_per_page', 10);

         $filters = [
            'start_date' => $request->input('start_date'),
            'end_date'   => $request->input('end_date'),
        ];

        $data = $this->monevInterface->getAllPaginate($search ?? null, $perPage, $filters);
        $data->appends($request->all());


        return view('admin.monev.index', compact('data'));
    }

    public function dataRealisasiMonev(Request $request){

         $search = $request->input('search');

         // Tangkap input dari form Blade
        $perPage = $request->input('row_per_page', 10);

         $filters = [
            'start_date' => $request->input('start_date'),
            'end_date'   => $request->input('end_date'),
        ];

        $data = $this->monevInterface->getAllPaginate($search ?? null, $perPage, $filters);
        $data->appends($request->all());


        return view('admin.realisasi.index', compact('data'));

    }

    public function create(){

        return view('admin.monev.create');
    }


    public function store(MonevApiStoreRequest $request){

        $validated = $request->validated();
         try{

            $monev = $this->monevInterface->create($validated);

            return redirect()->route('monev')->with('success', 'Data berhasil ditambah');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $exception->getMessage()]);
         }

    }

    public function show($id_bap){

            $monev = $this->monevInterface->getById($id_bap);

             if(!$monev){
                return redirect()->route('monev')->withErrors(['error' => 'Data tidak ditemukan']);
             }


        return view('admin.monev.detail', compact('monev'));
    }

    #nanti pake id
    public function showKeteranganUmum($id_bap){

      $monev = $this->monevInterface->getById($id_bap);

        if(!$monev){
            return redirect()->route('monev')->withErrors(['error' => 'Data tidak ditemukan']);
        }


        return view('admin.monev.editKeteranganUmum', compact('monev'));
    }

    public function updateKeteranganUmum(UpdateMonevUmumRequest $request, $id_bap){

        $validated = $request->validated();

        try{

            $monev = $this->monevInterface->getById($id_bap);

            if(!$monev){
                return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->withErrors(['error' => 'Data tidak ditemukan']);
            }

            $this->monevInterface->updateUmum($id_bap, $validated);

            return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->with('success', 'Data berhasil diperbarui');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $exception->getMessage()]);
         }
    }

    public function showKeteranganPerusahaan($id_bap){

        $monev = $this->monevInterface->getById($id_bap);

        if(!$monev){
            return redirect()->route('monev')->withErrors(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.monev.editKeteranganPerusahaan', compact('monev'));
    }

    public function updateKeteranganPerusahaan(UpdateKeteranganPerusahaanRequest $request, $id_bap){

        $validated = $request->validated();

        try{

            $monev = $this->monevInterface->getById($id_bap);

            if(!$monev){
                return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->withErrors(['error' => 'Data tidak ditemukan']);
            }

            $this->monevInterface->updateKeteranganPerusahaan($id_bap, $validated);

            return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->with('success', 'Data berhasil diperbarui');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $exception->getMessage()]);
         }

    }

    public function showHasilKesimpulan($id_bap){

         $monev = $this->monevInterface->getById($id_bap);

        if(!$monev){
            return redirect()->route('monev')->withErrors(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.monev.editKesimpulan', compact('monev'));
    }

    public function updateKesimpulan(UpdateKesimpulanRequest $request, $id_bap){

        $validated = $request->validated();

        try{

            $monev = $this->monevInterface->getById($id_bap);
            

            if(!$monev){
                return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->withErrors(['error' => 'Data tidak ditemukan']);
            }

            $this->monevInterface->updateHasilKesimpulan($id_bap, $validated);

            return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->with('success', 'Data berhasil diperbarui');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $exception->getMessage()]);
         }

    }

    public function showHasilFoto($id_bap){

        $monev = $this->monevInterface->getById($id_bap);

        if(!$monev){
            return redirect()->route('monev')->withErrors(['error' => 'Data tidak ditemukan']);
        }

        return view('admin.monev.EditFotoLokasi', compact('monev'));
    }

    public function updateFoto( MonevUpdateFotoApiRequest $request, $id_bap,){

         $validated = $request->validated();

        try{

            $monev = $this->monevInterface->getById($id_bap);

            if(!$monev){
                return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->withErrors(['error' => 'Data tidak ditemukan']);
            }

            $this->monevInterface->updateFoto($id_bap, $validated);

            return redirect()->route('admin.monev.detail', ['id_bap' => $id_bap])->with('success', 'Data berhasil diperbarui');

         }catch(Exception $exception){
                return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $exception->getMessage()]);
         }

    }

    public function updateLKPM(int $id_bap){
        try{    

            $monev = $this->monevInterface->getById($id_bap);

            if(!$monev){
                return back()->withErrors(['errorStatus' => 'Id Monev Tidak ditemukan']);
            }

            $updateStatus = $this->monevInterface->updateLKPM($id_bap);
            
            return response()->json([
                'success' => true,
                'data' => $updateStatus
            ]);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function updatePKKPR(int $id_bap){
        try{    

            $monev = $this->monevInterface->getById($id_bap);

            if(!$monev){
                return back()->withErrors(['errorStatus' => 'Id Monev Tidak ditemukan']);
            }

            $updateStatus = $this->monevInterface->updatePKKPR($id_bap);
            
            return response()->json([
                'success' => true,
                'data' => $updateStatus
            ]);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function izinLingkungan(int $id_bap){
         try{    

            $monev = $this->monevInterface->getById($id_bap);

            if(!$monev){
                return back()->withErrors(['errorStatus' => 'Id Monev Tidak ditemukan']);
            }

            $updateStatus = $this->monevInterface->updateIzinLingungan($id_bap);
            
            return response()->json([
                'success' => true,
                'data' => $updateStatus
            ]);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function updateSertifikatStandart(int $id_bap){
         try{    

            $monev = $this->monevInterface->getById($id_bap);

            if(!$monev){
                return back()->withErrors(['errorStatus' => 'Id Monev Tidak ditemukan']);
            }

            $updateStatus = $this->monevInterface->updateSertifikatStandart($id_bap);
            
            return response()->json([
                'success' => true,
                'data' => $updateStatus
            ]);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function downloadWord(int $id_bap){
        $monev = Monev::findOrFail($id_bap);

        $templatePath = storage_path('app/public/templates/1066bap.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('tanggal', \Carbon\Carbon::parse($monev->tanggal_bap)->translatedFormat('l, d F Y')); 
        $templateProcessor->setValue('nama_perusahaan', $monev->nama_perusahaan); 
        $templateProcessor->setValue('nama_pemimpin_perusahaan', $monev->nama_pemimpin_perusahaan); 
        $templateProcessor->setValue('no_telp', $monev->no_telp); 
        $templateProcessor->setValue('npwp', $monev->npwp ?? '-'); 
        $templateProcessor->setValue('status', $monev->status ?? '-'); 
        $templateProcessor->setValue('nama_penerima', $monev->nama_penerima ?? '..........'); 
        $templateProcessor->setValue('kesimpulan_saran', $monev->kesimpulan_saran ?? '..........'); 
        $templateProcessor->setValue('hasil_pemeriksaan', $monev->hasil_pemeriksaan ?? '..........'); 
        $templateProcessor->setValue('kelengkapan_legalitas', $monev->kelengkapan_legalitas ?? '..........'); 
        $templateProcessor->setValue('aspek_lingkungan', $monev->aspek_lingkungan ?? '..........'); 
        $templateProcessor->setValue('jabatan', $monev->jabatan ?? '..........'); 
        $templateProcessor->setValue('alamat_perusahaan', $monev->alamat_perusahaan); 
        $templateProcessor->setValue('bidang_usaha', $monev->bidang_usaha); 
        $templateProcessor->setValue('nilai_investasi', number_format((float)$monev->nilai_investasi, 0, ',', '.')); 
        $templateProcessor->setValue('jumlah_tenaga_kerja_indonesia', $monev->jumlah_tenaga_kerja_indonesia ?? 0); 
        $templateProcessor->setValue('jumlah_tenaga_kerja_asing', $monev->jumlah_tenaga_kerja_asing ?? 0); 

        $fileName = "BAP_" . str_replace(' ', '_', $monev->nama_perusahaan) . ".docx";
        $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
        $templateProcessor->saveAs($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    public function destroy( $id_bap){

        try{
            $this->monevInterface->delete($id_bap);
            return redirect()->route('monev')->with('success', value: 'Data berhasil dihapus');
        }catch(Exception $exception){

            return back()->withErrors(['error' => 'Gagal menghapus data: ' . $exception->getMessage()]);

        }
    }

    // ========== foto private ===============
    public function showFoto1($path){    

        //  $filePath = 'private/uploads/' . $path;

        // $filePath = '';

        //     if (str_contains($path, 'uploads/')) {
        //         $filePath = $path;
        //     } else {
                
        //         $filePath = '/uploads/' . $path;
        //     }

        // //  yang di dalam exits it path
        // if (!Storage::disk('local')->exists($filePath)) {
        //     abort(404);
        // }

        // return Storage::disk('local')->response($filePath);

        // 1. Bersihkan path dari karakter aneh atau double slash
        // Decode jika path mengandung karakter spesial (seperti spasi atau simbol)
         $path = rawurldecode($path);

        // 2. Pastikan path tidak dimulai dengan '/' agar tidak dianggap absolute path oleh disk
        $cleanPath = ltrim($path, '/');
        dd($cleanPath, Storage::disk('local')->path($cleanPath));

        // 3. Logika pengecekan 'uploads/'
        if (!str_contains($cleanPath, 'uploads/')) {
            $cleanPath = 'uploads/' . $cleanPath;
        }

        // DEBUG: Uncomment baris di bawah ini jika masih error untuk cek path yang dicari Laravel
        // dd(Storage::disk('local')->path($cleanPath));

        if (!Storage::disk('local')->exists($cleanPath)) {
            // Jika tidak ada, coba cek apakah file tersebut ada di folder public (opsional jika migrasi belum selesai)
            abort(404, 'File tidak ditemukan di path: ' . $cleanPath);
        }

        return Storage::disk('local')->response($cleanPath);
    }

    public function showFoto2($path) {
    $path = rawurldecode($path); // Menangani spasi dan karakter khusus
    $filePath = ltrim($path, '/');

    if (!str_contains($filePath, 'uploads/')) {
        $filePath = 'uploads/' . $filePath;
    }

    // DEBUGGING: Jika file tidak ditemukan, kita ingin tahu Laravel nyari ke mana
    if (!Storage::disk('local')->exists($filePath)) {
        // Ini akan memunculkan pesan error yang jelas di browser/network tab
        return response()->json([
            'error' => 'File tidak ada',
            'path_yang_dicari' => $filePath,
            'lokasi_full' => Storage::disk('local')->path($filePath),
            'cek_apakah_file_ada_fisik' => file_exists(Storage::disk('local')->path($filePath))
        ], 404);
    }

    return Storage::disk('local')->response($filePath);
    }
    public function showFoto3($path) {
    // 1. Decode URL dan hapus spasi di awal/akhir
    $path = trim(rawurldecode($path));

    // 2. Bersihkan path dari slash di awal agar tidak kacau
    $cleanPath = ltrim($path, '/');

    // 3. Logic penyesuaian path
    // Kita pastikan path-nya mengarah ke 'private/uploads/namafile.jpg'
    if (!str_contains($cleanPath, 'private/uploads/')) {
        // Jika di DB cuma 'uploads/foto.jpg'
        if (str_contains($cleanPath, 'uploads/')) {
            $filePath = 'private/' . $cleanPath;
        } 
        // Jika di DB cuma 'namafile.jpg'
        else {
            $filePath = 'private/uploads/' . $cleanPath;
        }
    } else {
        $filePath = $cleanPath;
    }

    // DEBUG ULANG (Jika masih error)
    if (!Storage::disk('local')->exists($filePath)) {
        return response()->json([
            'status' => 'Gagal',
            'pesan' => 'File fisik tidak ditemukan di folder storage',
            'path_db' => $path,
            'path_laravel_cari' => $filePath,
            'lokasi_absolut' => Storage::disk('local')->path($filePath),
        ], 404);
    }

    return Storage::disk('local')->response($filePath);
}
    public function showFoto4($path) {
    // 1. Decode agar spasi di nama file WhatsApp tidak jadi %20
    $path = rawurldecode($path);

    // 2. Buang semua prefix yang mungkin ada agar kita dapat nama filenya saja
    // Kita bersihkan 'private/' atau 'uploads/' jika terbawa dari DB
    $cleanName = str_replace(['private/', 'uploads/'], '', $path);
    $cleanName = ltrim($cleanName, '/'); // Buang slash di depan jika ada

    // 3. Susun path standar yang baru
    $finalPath = 'private/uploads/' . $cleanName;

    // 4. Cek di storage
    if (!Storage::disk('local')->exists($finalPath)) {
        // Jika masih tidak ada, kita coba cek kemungkinan tanpa 'private/' 
        // (siapa tahu strukturnya berbeda)
        $altPath = 'uploads/' . $cleanName;
        
        if (Storage::disk('local')->exists($altPath)) {
            return Storage::disk('local')->response($altPath);
        }

        abort(404, "File tidak ditemukan: " . $finalPath);
    }

    return Storage::disk('local')->response($finalPath);
    }
    
    public function showFoto5($path){
        // decode karakter spesial
    $path = rawurldecode($path);

    // hilangkan slash di depan
    $path = ltrim($path, '/');

    // jika database hanya menyimpan nama file
    // paksa masuk ke folder uploads
    if (!str_contains($path, 'uploads/')) {
        $path = 'uploads/' . $path;
    }

    // path final di storage
    $filePath = $path;

    // debug jika perlu
    // dd(Storage::disk('local')->path($filePath));

    if (!Storage::disk('local')->exists($filePath)) {
        abort(404, 'File tidak ditemukan: ' . $filePath);
    }

    return Storage::disk('local')->response($filePath);
    }

    public function showFoto($path)
{
    $path = rawurldecode($path);
    $path = trim($path);
    $path = ltrim($path, '/');

    $possiblePaths = [
        $path,                 // private/nama_file.jpg
        'uploads/' . $path,    // private/uploads/nama_file.jpg (jika nanti ada)
        'upload/' . $path      // antisipasi dari CI
    ];

    foreach ($possiblePaths as $filePath) {
        if (Storage::disk('local')->exists($filePath)) {
            return Storage::disk('local')->response($filePath);
        }
    }

    abort(404, 'File tidak ditemukan: ' . $path);
}
    // ========== batas foto private ==========

    // ============  path dari ci ke larave   ===============

    //     function fotoLapanganPath($file)
    // {
    //     if (!$file) {
    //         return null;
    //     }

    //     // jika file dari Laravel
    //     if (str_contains($file, 'uploads/')) {
    //         return $file;
    //     }

    //     // jika file dari CI
    //     return 'uploads/' . $file;
    // }

    // ===========   batas path dari ci ke laravel ==========

    public function export()
{
    return Excel::download(new MonevExport, 'data_monev.xlsx');
}

    public function exportPembinaan()
{
    return Excel::download(new PembinaanExport, 'data_pembinaan.xlsx');
}

    public function exportTkiTka(){
        
        return Excel::download(new TkiTkaExport, 'data_tenaga_kerja_tki_tka.xlsx');
    }






}
