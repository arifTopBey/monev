<?php

namespace App\Repository;

use App\Interface\MonevInterface;
use App\Models\Monev;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MonevRepositoryInterface implements MonevInterface
{


    public function getAll(?string $search, ?int $limit, bool $execute,array $filters = [])
    {

        $query = Monev::where(function ($query) use ($search) {

            if ($search) {
                $query->search($search);
            }
        });

        if (!empty($filters['start_date'])) {
        $query->whereDate('tanggal_bap', '>=', $filters['start_date']);
        }

        if (!empty($filters['end_date'])) {
            $query->whereDate('tanggal_bap', '<=', $filters['end_date']);
        }

        $query->orderByDesc('id_bap');

        if ($limit) {
            $query->take($limit);
        }

        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginate(?string $search, ?int $rowPerPage,array $filters = [])
    {

        $query = $this->getAll($search, $rowPerPage, false, $filters);

        return  $query->paginate($rowPerPage);
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {


            $monev = new Monev();
            $monev->nama_perusahaan = $data['nama_perusahaan'];
            $monev->bidang_usaha = $data['bidang_usaha'];
            $monev->alamat_perusahaan = $data['alamat_perusahaan'];
            $monev->foto_lapangan = $data['foto_lapangan']->store('uploads', 'local');

            if (isset($data['foto_lapangan2'])) {
                $monev->foto_lapangan2 = $data['foto_lapangan2']->store('uploads', 'local');
            }
            if (isset($data['foto_lapangan3'])) {
                $monev->foto_lapangan3 = $data['foto_lapangan3']->store('uploads', 'local');
            }
            $monev->no_telp = $data['no_telp'];
            $monev->location = $data['location'];
            $monev->latitude = $data['latitude'];
            $monev->longitude = $data['longitude'];
            $monev->radius = $data['radius'];


            $monev->save();

            DB::commit();

            return $monev;
        } catch (Exception $exception) {

            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function getById($id_bap)
    {

        $monev = Monev::where('id_bap', $id_bap)->first();

        return $monev;
    }

    public function updateUmum($id_bap, array $data)
    {

        DB::beginTransaction();

        try {
            $monev = Monev::where('id_bap', $id_bap)->first();

            if (!$monev) {
                throw new Exception('Data tidak ditemukan');
            }

            if (isset($data['nama_penerima'])) {
                $monev->nama_penerima = $data['nama_penerima'];
            }
            if (isset($data['tanggal_bap'])) {
                $monev->tanggal_bap = $data['tanggal_bap'];
            }
            if (isset($data['jabatan'])) {
                $monev->jabatan = $data['jabatan'];
            }
            if (isset($data['alamat_perusahaan'])) {
                $monev->alamat_perusahaan = $data['alamat_perusahaan'];
            }
            if (isset($data['no_telp'])) {
                $monev->no_telp = $data['no_telp'];
            }

            $monev->save();

            DB::commit();

            return $monev;
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function updateKeteranganPerusahaan($id_bap, array $data)
    {
        DB::beginTransaction();

        try {
            $monev = Monev::where('id_bap', $id_bap)->first();

            if (isset($data['nama_perusahaan'])) {
                $monev->nama_perusahaan = $data['nama_perusahaan'];
            }
            if (isset($data['bidang_usaha'])) {
                $monev->bidang_usaha = $data['bidang_usaha'];
            }
            if (isset($data['status'])) {
                $monev->status = $data['status'];
            }
            if (isset($data['npwp'])) {
                $monev->npwp = $data['npwp'];
            }
            if (isset($data['nama_pemimpin_perusahaan'])) {
                $monev->nama_pemimpin_perusahaan = $data['nama_pemimpin_perusahaan'];
            }
            if (isset($data['nilai_investasi'])) {
                $monev->nilai_investasi = $data['nilai_investasi'];
            }
            if (isset($data['jumlah_tenaga_kerja_asing'])) {
                $monev->jumlah_tenaga_kerja_asing = $data['jumlah_tenaga_kerja_asing'];
            }
            if (isset($data['jumlah_tenaga_kerja_indonesia'])) {
                $monev->jumlah_tenaga_kerja_indonesia = $data['jumlah_tenaga_kerja_indonesia'];
            }
            if (isset($data['aspek_lingkungan'])) {
                $monev->aspek_lingkungan = $data['aspek_lingkungan'];
            }
            if (isset($data['kelengkapan_legalitas'])) {
                $monev->kelengkapan_legalitas = $data['kelengkapan_legalitas'];
            }

            $monev->save();

            DB::commit();

            return $monev;
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function updateHasilKesimpulan($id_bap, array $data)
    {

        DB::beginTransaction();

        try {
            $monev = Monev::where('id_bap', $id_bap)->first();

            if (isset($data['hasil_pemeriksaan'])) {
                $monev->hasil_pemeriksaan = $data['hasil_pemeriksaan'];
            }
            if (isset($data['kesimpulan_saran'])) {
                $monev->kesimpulan_saran = $data['kesimpulan_saran'];
            }

            $monev->save();

            DB::commit();

            return $monev;
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function updateFoto($id_bap, array $data)
    {
        DB::beginTransaction();

        try {
            $monev = Monev::where('id_bap', $id_bap)->first();


            if(isset($data['location'])){
                $monev->location = $data['location'];
            }

            if(isset($data['latitude'])){
                $monev->latitude = $data['latitude'];
            }

            if(isset($data['longitude'])){
                $monev->longitude = $data['longitude'];
            }

            if(isset($data['radius'])){
                $monev->radius = $data['radius'];
            }



            // Cek apakah ada input foto_lapangan baru
            if (isset($data['foto_lapangan'])) {

                if ($monev->foto_lapangan && Storage::disk('local')->exists($monev->foto_lapangan)) {
                    Storage::disk('local')->delete($monev->foto_lapangan);
                }
                $newPath = $data['foto_lapangan']->store('uploads', 'local');
                // 3. Update path di database
                $monev->foto_lapangan = $newPath;
            }


            if (isset($data['foto_lapangan2'])) {
                if ($monev->foto_lapangan2 && Storage::disk('local')->exists($monev->foto_lapangan2)) {
                    Storage::disk('local')->delete($monev->foto_lapangan2);
                }
                $monev->foto_lapangan2 = $data['foto_lapangan2']->store('uploads', 'local');
            }

            if (isset($data['foto_lapangan3'])) {
                if ($monev->foto_lapangan3 && Storage::disk('local')->exists($monev->foto_lapangan3)) {
                    Storage::disk('local')->delete($monev->foto_lapangan23);
                }
                $monev->foto_lapangan3 = $data['foto_lapangan3']->store('uploads', 'local');
            }

            $monev->save();

            DB::commit();
            return $monev;
        } catch (Exception $exception) {
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function delete($id_bap){
         DB::beginTransaction();

        try{

            $monev = Monev::find($id_bap);

            $fotos = [
                $monev->foto_lapangan,
                $monev->foto_lapangan2,
                $monev->foto_lapangan3
            ];

            foreach ($fotos as $fotoPath) {
                if ($fotoPath && Storage::disk('local')->exists($fotoPath)) {
                    Storage::disk('local')->delete($fotoPath);
                }
            }

            $monev->delete();
            DB::commit();

            return $monev;

        }catch(Exception $exception){

            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

}
