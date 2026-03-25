<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonevResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
            'id_bap' => $this->id_bap,
            'no_bap' => $this->no_bap,
            'tanggal_input' => $this->tanggal_input,
            'tanggal_bap' => $this->tanggal_bap,
            'nama_penerima' => $this->nama_penerima,
            'jabatan' => $this->jabatan,
            'nama_perusahaan' => $this->nama_perusahaan,
            'izin_dimiliki' => new IzinDimilikiResource($this->izinDimiliki),
            'alamat_perusahaan' => $this->alamat_perusahaan,
            'titik_kordinat' => $this->titik_kordinat,
            'no_telp' => $this->no_telp,
            'bidang_usaha' => $this->bidang_usaha,
            'status' => $this->status,
            'npwp' => $this->npwp,
            'nama_pemimpin_perusahaan' => $this->nama_pemimpin_perusahaan,
            'nilai_investasi' => $this->nilai_investasi,
            'jumlah_tenaga_kerja_asing' => $this->jumlah_tenaga_kerja_asing,
            'jumlah_tenaga_kerja_indonesia' => $this->jumlah_tenaga_kerja_indonesia,
            'aspek_lingkungan' => $this->aspek_lingkungan,
            'kelengkapan_legalitas' => $this->kelengkapan_legalitas,
            'hasil_pemeriksaan' => $this->hasil_pemeriksaan,
            'kesimpulan_saran' => $this->kesimpulan_saran,
            'penanggung_jawab' => $this->penanggung_jawab,
            'tim_monitoring' => $this->tim_monitoring,
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longtitude' => $this->longtitude,
            'radius' => $this->radius,
            // 'foto_lapangan' => $this->foto_lapanagan,
            // 'foto_lapangan2' => $this->foto_lapangan2,
            // 'foto_lapangan3' => $this->foto_lapangan3,
            'foto_lapangan_url' => $this->foto_lapangan ? url('api/v1/foto/' . $this->foto_lapangan) : null,
            'foto_lapangan2_url' => $this->foto_lapangan2? url('api/v1/foto/' . $this->foto_lapangan2) : null,
            'foto_lapangan3_url' => $this->foto_lapangan3? url('api/v1/foto/' . $this->foto_lapangan3): null,
            'nomor_nib' => $this->nomor_nib,
            'tanggal_terbit_nib' => $this->tanggal_terbit_nib,
            'nomor_kode_proyek' => $this->nomor_kode_proyek,
            'kegiatan_usaha' => $this->kegiatan_usaha,
            'persyaratan_dasar_izin' => $this->persyaratan_dasar_izin,
            'sertifikat_standard_izin' => $this->sertifikat_standart_izin,
            'fasilitas_penanaman_modal' => $this->fasilitas_penanaman_modal,
            'pemenuhan_standar_usaha' => $this->pemenuhan_standar_usaha,
            'pemenuhan_standar_produk' => $this->pemenuhan_standar_produk,
            'nilai_rencana_dan_realisasi_investasi' => $this->nilai_rencana_dan_realisasi_investasi,
            'penyerapan_tenaga_kerja' => $this->penyerapan_tenaga_kerja,
            'kewajiban' => $this->kewajiban,
            'penilaian_kepatuhan' => $this->penilaian_kepatuhan,
            'permasalahan_yang_dihadapi' => $this->permasalahan_yang_dihadapi,
            'dokument_pendukung' => $this->dokument_pendukung,
            'rekomendasi' => $this->rekomendasi


       ];
    }
}
