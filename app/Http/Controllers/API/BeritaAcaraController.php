<?php

namespace App\Http\Controllers\API;

use App\BeritaAcara;
use App\Kehadiran;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\BeritaAcaraCollection;
use App\Http\Resources\BeritaAcara as BeritaAcaraResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
use App\Jadwal;

class BeritaAcaraController extends BaseController
{
    /**
     * Menyimpan berita acara perkuliahan.
     * Digunakan untuk aplikasi mobile.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buatBeritaAcara(Request $request){
        // Validasi data
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_jadwal' => 'required|exists:App\Jadwal,kd_jadwal',
            'desk_perkuliahan' => 'required',
            'desk_penugasan' => 'required'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        // Mengambil tanggal hari ini
        $date = Carbon::now()->timezone('Asia/Jakarta');
        $tanggal_sekarang = $date->format('Y-m-d');
        $jam_sekarang = $date->format('H:i:s');

        // Pengecekan data jadwal
        $jadwal = Jadwal::find($request->kd_jadwal);
        if($jadwal==null) return $this->sendError('Jadwal tidak ditemukan!');
        if($jadwal->sesi_presensi_dibuka) return $this->sendError('Tutup sesi presensi terlebih dahulu!');
        if($jadwal->jam_presensi_ditutup==null) return $this->sendError('Matakuliah belum anda mulai!');

        // Mengambil kode sesi berakhir
        $sesi_akhir = $jadwal->kd_sesi_berakhir;

        // Penghitungan jumlah kehadiran mahasiswa berdasarkan sesi terakhir
        $jml_mhs_hadir = Kehadiran::where('kd_jadwal', $request->kd_jadwal)
        ->where('tgl_presensi', $tanggal_sekarang)
        ->where('kd_sesi', $sesi_akhir)
        ->where('kd_status_presensi', 'H')
        ->get()
        ->count();

        $jml_mhs_tdk_hadir = Kehadiran::where('kd_jadwal', $request->kd_jadwal)
        ->where('tgl_presensi', $tanggal_sekarang)
        ->where('kd_sesi', $sesi_akhir)
        ->where('kd_status_presensi', '!=', 'H')
        ->get()
        ->count();
        
        if($jml_mhs_hadir == 0 && $jml_mhs_tdk_hadir == 0) return $this->sendError('Data kehadiran tidak boleh kosong!');

        // Mengambil jam sesi presensi dibuka dan ditutup
        $jam_presensi_dibuka = $jadwal->jam_presensi_dibuka;
        $jam_presensi_ditutup = $jadwal->jam_presensi_ditutup;

        // Melakukan generate kode berita acara
        $temp_berita_acara = BeritaAcara::all()->last();
        $kd_berita_acara = "BeritaAcara0001";
        if($temp_berita_acara) $kd_berita_acara = ++$temp_berita_acara->kd_berita_acara;

        // Assign data berita acara ke object
        $beritaAcara = new BeritaAcara;
        $beritaAcara->kd_berita_acara = $kd_berita_acara;
        $beritaAcara->desk_perkuliahan = $request->desk_perkuliahan;
        $beritaAcara->desk_penugasan = $request->desk_penugasan;
        $beritaAcara->tgl_pertemuan = $tanggal_sekarang;
        $beritaAcara->mhs_hadir = $jml_mhs_hadir;
        $beritaAcara->mhs_tidak_hadir = $jml_mhs_tdk_hadir;
        $beritaAcara->jam_presensi_dibuka = $jam_presensi_dibuka;
        $beritaAcara->jam_presensi_ditutup = $jam_presensi_ditutup;
        $beritaAcara->jadwal()->associate($jadwal);

        // Memastikan tidak duplikasi berita acara
        $temp_berita_acara = BeritaAcara::where('kd_jadwal', $jadwal->kd_jadwal)
        ->where('tgl_pertemuan', $tanggal_sekarang)
        ->get();
        if($temp_berita_acara->count()!=0) return $this->sendError('Berita acara sudah diisi!');

        // Menyimpan object berita acara ke database
        $beritaAcara->save();

        return $this->sendResponse([
            'berita_acara' => new BeritaAcaraResource($beritaAcara)
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BeritaAcaraCollection(BeritaAcara::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'gte' => [
                'numeric' => 'Atribut :attribute harus memiliki nilai sama dengan atau lebih besar dari :value.',
            ],
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
        ];
        $validator = Validator::make($request->all(), [
            'kd_jadwal' => 'required|exists:App\Jadwal,kd_jadwal',
            'tgl_pertemuan' => 'required|date_format:Y-n-j',
            'mhs_hadir' => 'required|numeric|gte:0',
            'mhs_tidak_hadir' => 'required|numeric|gte:0',
            'jam_presensi_dibuka' => 'required|date_format:H:i:s',
            'jam_presensi_ditutup' => 'required|date_format:H:i:s|after_or_equal:jam_presensi_dibuka'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $temp_berita_acara = BeritaAcara::all()->last();
        $kd_berita_acara = "BeritaAcara0001";
        if($temp_berita_acara) $kd_berita_acara = ++$temp_berita_acara->kd_berita_acara;

        $jadwal = Jadwal::find($request->kd_jadwal);
        if(!$jadwal) return $this->sendError('Data jadwal tidak ditemukan!');
        
        $beritaAcara = new BeritaAcara;
        $beritaAcara->kd_berita_acara = $kd_berita_acara;
        $beritaAcara->desk_perkuliahan = $request->desk_perkuliahan;
        $beritaAcara->desk_penugasan = $request->desk_penugasan;
        $beritaAcara->tgl_pertemuan = $request->tgl_pertemuan;
        $beritaAcara->mhs_hadir = $request->mhs_hadir;
        $beritaAcara->mhs_tidak_hadir = $request->mhs_tidak_hadir;
        $beritaAcara->jam_presensi_dibuka = $request->jam_presensi_dibuka;
        $beritaAcara->jam_presensi_ditutup = $request->jam_presensi_ditutup;
        $beritaAcara->jadwal()->associate($jadwal);
        $beritaAcara->save();
        
        return $this->sendResponse([
            'berita_acara' => [new BeritaAcaraResource($beritaAcara)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BeritaAcara  $beritaAcara
     * @return \Illuminate\Http\Response
     */
    public function show(BeritaAcara $beritaAcara)
    {
        if($beritaAcara) return $this->sendResponse([
            'berita_acara' => new BeritaAcaraResource($beritaAcara)
        ],'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BeritaAcara  $beritaAcara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BeritaAcara $beritaAcara)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'gte' => [
                'numeric' => 'Atribut :attribute harus memiliki nilai sama dengan atau lebih besar dari :value.',
            ],
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
        ];
        $validator = Validator::make($request->all(), [
            'kd_berita_acara' => 'required|exists:App\BeritaAcara,kd_berita_acara',
            'kd_jadwal' => 'required|exists:App\Jadwal,kd_jadwal',
            'tgl_pertemuan' => 'required|date_format:Y-n-j',
            'mhs_hadir' => 'required|numeric|gte:0',
            'mhs_tidak_hadir' => 'required|numeric|gte:0',
            'jam_presensi_dibuka' => 'required|date_format:H:i:s',
            'jam_presensi_ditutup' => 'required|date_format:H:i:s|after_or_equal:jam_presensi_dibuka'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $jadwal = Jadwal::find($request->kd_jadwal);
        if(!$jadwal) return $this->sendError('Data jadwal tidak ditemukan!');

        $beritaAcara->desk_perkuliahan = $request->desk_perkuliahan;
        $beritaAcara->desk_penugasan = $request->desk_penugasan;
        $beritaAcara->tgl_pertemuan = $request->tgl_pertemuan;
        $beritaAcara->mhs_hadir = $request->mhs_hadir;
        $beritaAcara->mhs_tidak_hadir = $request->mhs_tidak_hadir;
        $beritaAcara->jam_presensi_dibuka = $request->jam_presensi_dibuka;
        $beritaAcara->jam_presensi_ditutup = $request->jam_presensi_ditutup;
        $beritaAcara->jadwal()->associate($jadwal);
        $beritaAcara->update();
        
        return $this->sendResponse([
            'berita_acara' => [new BeritaAcaraResource($beritaAcara)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BeritaAcara  $beritaAcara
     * @return \Illuminate\Http\Response
     */
    public function destroy(BeritaAcara $beritaAcara)
    {
        $beritaAcara->delete();
        return $this->sendResponse(null,'Berhasil menghapus data!');
    }
}
