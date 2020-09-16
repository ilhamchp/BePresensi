<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Kehadiran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\KehadiranCollection;
use App\Http\Resources\Kehadiran as KehadiranResource;
use App\Http\Resources\Mobile\ListRiwayatKehadiranCollection;
use App\Http\Resources\Mobile\DetailRiwayatKehadiran;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Validator;
use Illuminate\Support\Arr;
use App\Mahasiswa;
use App\Jadwal;
use App\Sesi;
use App\StatusPresensi;
use App\SuratIzin;

class KehadiranController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new KehadiranCollection(Kehadiran::all());
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
            'alpha' => 'Atribut :attribute hanya boleh berupa alfabet.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'required_if' => 'Atribut :attribute dibutuhkan jika :other berisi :value.',
        ];
        $validator = Validator::make($request->all(), [
            'nim' => 'required|exists:App\Mahasiswa,nim',
            'kd_jadwal' => 'required|exists:App\Jadwal,kd_jadwal',
            'kd_sesi' => 'required|numeric|exists:App\Sesi,kd_sesi',
            'kd_status_presensi' => 'required|alpha|exists:App\StatusPresensi,kd_status_presensi',
            'kd_surat_izin' => 'exists:App\SuratIzin,kd_surat_izin',
            'tgl_presensi' => 'required|date_format:Y-n-j',
            'jam_presensi' => 'required_if:kd_status_presensi,H|date_format:H:i:s',
            'jam_presensi_dibuka' => 'required|date_format:H:i:s'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        $jadwal = Jadwal::find($request->kd_jadwal);
        if(!$jadwal) return $this->sendError('Data jadwal tidak ditemukan!');

        $sesi = Sesi::find($request->kd_sesi);
        if(!$sesi) return $this->sendError('Data sesi tidak ditemukan!');

        $statusPresensi = StatusPresensi::find($request->kd_status_presensi);
        if(!$statusPresensi) return $this->sendError('Data status presensi tidak ditemukan!');

        if($request->kd_surat_izin){
            $suratIzin = SuratIzin::find($request->kd_surat_izin);
            if(!$suratIzin) return $this->sendError('Data surat izin tidak ditemukan!'); 
        }

        $kehadiran = new Kehadiran;
        $kehadiran->tgl_presensi = $request->tgl_presensi;
        $kehadiran->jam_presensi = $request->jam_presensi;
        $kehadiran->jam_presensi_dibuka = $request->jam_presensi_dibuka;
        $kehadiran->mahasiswa()->associate($mahasiswa);
        $kehadiran->jadwal()->associate($jadwal);
        $kehadiran->sesi()->associate($sesi);
        $kehadiran->statusPresensi()->associate($statusPresensi);
        if($request->kd_surat_izin) $kehadiran->suratIzin()->associate($suratIzin);
        $kehadiran->save();
        
        return $this->sendResponse([
            'kehadiran' => [new KehadiranResource($kehadiran)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function show(Kehadiran $kehadiran)
    {
        if($kehadiran) return $this->sendResponse([
            'kehadiran' => new KehadiranResource($kehadiran)
        ],'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'alpha' => 'Atribut :attribute hanya boleh berupa alfabet.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'required_if' => 'Atribut :attribute dibutuhkan jika :other berisi :value.',
        ];
        $validator = Validator::make($request->all(), [
            'nim' => 'required|exists:App\Mahasiswa,nim',
            'kd_jadwal' => 'required|exists:App\Jadwal,kd_jadwal',
            'kd_sesi' => 'required|numeric|exists:App\Sesi,kd_sesi',
            'kd_status_presensi' => 'required|alpha|exists:App\StatusPresensi,kd_status_presensi',
            'kd_surat_izin' => 'exists:App\SuratIzin,kd_surat_izin',
            'tgl_presensi' => 'required_if:kd_status_presensi,H|date_format:Y-n-j',
            'jam_presensi' => 'required_if:kd_status_presensi,H|date_format:H:i:s',
            'jam_presensi_dibuka' => 'required|date_format:H:i:s'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        $jadwal = Jadwal::find($request->kd_jadwal);
        if(!$jadwal) return $this->sendError('Data jadwal tidak ditemukan!');

        $sesi = Sesi::find($request->kd_sesi);
        if(!$sesi) return $this->sendError('Data sesi tidak ditemukan!');

        $statusPresensi = StatusPresensi::find($request->kd_status_presensi);
        if(!$statusPresensi) return $this->sendError('Data status presensi tidak ditemukan!');

        if($request->kd_surat_izin){
            $suratIzin = SuratIzin::find($request->kd_surat_izin);
            if(!$suratIzin) return $this->sendError('Data surat izin tidak ditemukan!'); 
        }

        $kehadiran->tgl_presensi = $request->tgl_presensi;
        $kehadiran->jam_presensi = $request->jam_presensi;
        $kehadiran->jam_presensi_dibuka = $request->jam_presensi_dibuka;
        $kehadiran->mahasiswa()->associate($mahasiswa);
        $kehadiran->jadwal()->associate($jadwal);
        $kehadiran->sesi()->associate($sesi);
        $kehadiran->statusPresensi()->associate($statusPresensi);
        if($request->kd_surat_izin) $kehadiran->suratIzin()->associate($suratIzin);
        $kehadiran->update();
        
        return $this->sendResponse([
            'kehadiran' => [new KehadiranResource($kehadiran)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kehadiran $kehadiran)
    {
        $kehadiran->delete();
        return $this->sendResponse(null, 'Berhasil menghapus kehadiran!');
    }

    /**
     * Menampilkan riwayat kehadiran perkuliahan mahasiswa minggu ini.
     * Digunakan untuk aplikasi mobile.
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function riwayatKehadiran(Mahasiswa $mahasiswa)
    {
        if(!$mahasiswa) return $this->sendError('Data tidak ditemukan!');

        $date = Carbon::now()->timezone('Asia/Jakarta');
        $kd_hari = $date->dayOfWeek;
        if($kd_hari==0) $kd_hari = 7;
        $tanggal = $date->format('Y-m-d');
        $nim = $mahasiswa->nim;
        $mahasiswa = Mahasiswa::find($nim);
        $startOfWeek = $date->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $awalMinggu = Carbon::parse($startOfWeek);
        $collection = new Collection();
        for($i=1;$i<=$kd_hari;$i++){
            $jadwal = Jadwal::where('kd_kelas','=',$mahasiswa->kd_kelas)
            ->where('kd_hari','=',$i)
            ->with([
                'kehadiran' => function($query) use ($nim,$awalMinggu){
                    $query->where('nim',$nim)->where('tgl_presensi',$awalMinggu->format('Y-m-d'));
                }
            ])
            ->get();
            if($jadwal->count()!=0){
                $collection->push(
                    (object)[
                        'tanggal' => $awalMinggu->format('Y-m-d'),
                        'jadwal' => $jadwal
                    ]
                );
            }
            $awalMinggu = $awalMinggu->addDay();
        }
        return new ListRiwayatKehadiranCollection($collection);
    }

    /**
     * Menampilkan detail kehadiran sebuah sesi perkuliahan.
     * Digunakan untuk aplikasi mobile.
     * 
     * @param  \App\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function detailRiwayatKehadiran(Kehadiran $kehadiran)
    {
        if($kehadiran) return $this->sendResponse([
            'kehadiran' => new DetailRiwayatKehadiran($kehadiran)
        ],'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Menampilkan detail kehadiran sebuah sesi perkuliahan.
     * Digunakan untuk aplikasi mobile.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function catatPresensi(Request $request)
    {
        // Validasi kelengkapan data
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
        ];

        $validator = Validator::make($request->all(), [
            'nim' => 'required|exists:App\Mahasiswa,nim',
            'kd_jadwal' => 'required|exists:App\Jadwal,kd_jadwal',
        ],$messages);
   
        if($validator->fails()) return $this->sendError('', Arr::first(Arr::flatten($validator->messages()->get('*'))));       


        // Mengambil data jadwal
        $jadwal = Jadwal::find($request->kd_jadwal);
        if($jadwal->sesi_presensi_dibuka==false) return $this->sendError('Sesi presensi belum dibuka!');

        // Mengambil data waktu sekarang
        $date = Carbon::now()->timezone('Asia/Jakarta');
        $tanggal_sekarang = $date->format('Y-m-d');
        $jam_sekarang = Carbon::createFromFormat('H:i:s', $date->format('H:i:s'), 'Asia/Jakarta');

        // Mengambil data kehadiran sekarang
        $kehadiran = Kehadiran::where('nim',$request->nim)
        ->where('kd_jadwal', $request->kd_jadwal)
        ->where('tgl_presensi', $tanggal_sekarang)
        ->get();

        if($kehadiran->count() == 0) return $this->sendError('Silahkan ulangi proses buka sesi presensi!'); 

        // Mengambil data sesi mulai, berakhir, dan toleransi
        // keterlambatan jadwal
        $sesi_mulai = $jadwal->kd_sesi_mulai;
        $sesi_berakhir = $jadwal->kd_sesi_berakhir;
        $toleransi_keterlambatan = $jadwal->toleransi_keterlambatan;
        $jam_presensi_dibuka = Carbon::createFromFormat('H:i:s', $jadwal->jam_presensi_dibuka, 'Asia/Jakarta');
        $jam_batas_toleransi = Carbon::createFromFormat('H:i:s', $jadwal->jam_presensi_dibuka, 'Asia/Jakarta');
        $jam_batas_toleransi->addMinutes(intval($toleransi_keterlambatan));

        // Validasi data
        $jumlah_sesi = ($sesi_berakhir - $sesi_mulai) + 1;
        if($kehadiran->count() == 0) return $this->sendError('Silahkan ulangi proses buka sesi presensi!'); 

        // Menentukan sesi yang dihadiri mhs 
        $sesi_dihadiri = array();
        for($kd_sesi = $sesi_mulai;
            $kd_sesi <= $sesi_berakhir;
            $kd_sesi++){

            $sesi = Sesi::find($kd_sesi);
            $jam_mulai = Carbon::createFromFormat('H:i:s', $sesi->jam_mulai, 'Asia/Jakarta');
            $jam_berakhir = Carbon::createFromFormat('H:i:s',$sesi->jam_berakhir, 'Asia/Jakarta');

            if($jam_sekarang->lessThanOrEqualTo($jam_berakhir)){ // Cek apakah telat
                if($kd_sesi == $sesi_mulai){ // Cek apakah jam pertama
                    if(($jam_sekarang->greaterThanOrEqualTo($jam_presensi_dibuka))
                    && ($jam_sekarang->lessThanOrEqualTo($jam_batas_toleransi))){ // Cek apakah telat jam pertama
                        for($kd_sesi_dihadiri = $kd_sesi;
                            $kd_sesi_dihadiri <= $sesi_berakhir;
                            $kd_sesi_dihadiri++){
                            $sesi_dihadiri[] = $kd_sesi_dihadiri;
                        }
                        break;
                    }else{ // Jika telat
                        // Dianggap di jam perkuliahan berikutnya
                    }
                }else{ // Jika bukan jam pertama
                    for($kd_sesi_dihadiri = $kd_sesi;
                        $kd_sesi_dihadiri <= $sesi_berakhir;
                        $kd_sesi_dihadiri++){
                        $sesi_dihadiri[] = $kd_sesi_dihadiri;
                    }
                    break;
                }
            }else{ // Jika telat
                // Dianggap di jam kehadiran berikutnya
            }
        }

        if(count($sesi_dihadiri) !=0){
            foreach($kehadiran as $data_kehadiran){
                foreach($sesi_dihadiri as $sesi_hadir){
                    if($data_kehadiran->kd_sesi == $sesi_hadir){
                        $data_kehadiran->kd_status_presensi = 'H';
                        $data_kehadiran->tgl_presensi = $tanggal_sekarang;
                        $data_kehadiran->jam_presensi = $jam_sekarang->format('H:i:s');
                        $data_kehadiran->update();
                    }
                }
            }
        }else{
            return $this->sendError('Gagal catat presensi!');
        }

        return $this->sendResponse([
            new KehadiranCollection($kehadiran)
        ], 'Berhasil catat presensi!');
    }
}
