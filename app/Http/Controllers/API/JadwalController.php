<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Jadwal;
use Illuminate\Http\Request;
use App\Http\Resources\JadwalCollection;
use App\Http\Resources\Mobile\ListJadwalMahasiswaCollection;
use App\Http\Resources\Mobile\ListJadwalDosenCollection;
use App\Http\Resources\Jadwal as JadwalResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use App\BeritaAcara;
use App\Kehadiran;
use App\Kelas;
use App\Ruang;
use App\Dosen;
use App\Matakuliah;
use App\Sesi;
use App\Hari;
use App\Mahasiswa;

class JadwalController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new JadwalCollection(Jadwal::all());
    }

    /**
     * Menampilkan jadwal perkuliahan mahasiswa hari ini.
     * Digunakan untuk aplikasi mobile.
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function jadwalMahasiswa(Mahasiswa $mahasiswa)
    {
        if(!$mahasiswa) return $this->sendError('Data tidak ditemukan!');

        $date = Carbon::now()->timezone('Asia/Jakarta');
        $kd_hari = $date->dayOfWeek;
        $tanggal = $date->format('Y-m-d');
        $nim = $mahasiswa->nim;
        $jadwal = Jadwal::where('kd_kelas','=',$mahasiswa->kd_kelas)
        ->where('kd_hari','=',$kd_hari)
        ->with([
            'kehadiran' => function($query) use ($nim,$tanggal){
                $query->where('nim',$nim)->where('tgl_presensi',$tanggal);
            }
        ])->get();
        if(!$jadwal) return $this->sendError('Tidak ada matakuliah hari ini!');
        return new ListJadwalMahasiswaCollection($jadwal);
    }

    /**
     * Menampilkan jadwal perkuliahan mahasiswa hari ini.
     * Digunakan untuk aplikasi mobile.
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function jadwalDosen(Dosen $dosen)
    {
        if(!$dosen) return $this->sendError('Data tidak ditemukan!');

        $date = Carbon::now()->timezone('Asia/Jakarta');
        $kd_hari = $date->dayOfWeek;
        $tanggal = $date->format('Y-m-d');
        $kd_dosen = $dosen->kd_dosen;
        $jadwal = Jadwal::where('kd_dosen_pengajar','=',$kd_dosen)
        ->where('kd_hari','=',$kd_hari)
        ->with([
            'beritaAcara' => function($query) use ($tanggal){
                $query->where('tgl_pertemuan',$tanggal);
            }
        ])
        ->with([
            'kehadiran' => function($query) use ($tanggal){
                $query->where('tgl_presensi', $tanggal);
            }
        ])
        ->get();
        if(!$jadwal) return $this->sendError('Tidak ada matakuliah hari ini!');
        return new ListJadwalDosenCollection($jadwal);
    }

    /**
     * Menampilkan semua jadwal yang diampu dosen.
     * Digunakan untuk aplikasi mobile.
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function jadwalDiampuDosen(Dosen $dosen)
    {
        if(!$dosen) return $this->sendError('Data tidak ditemukan!');

        $jadwal = Jadwal::where('kd_dosen_pengajar','=',$dosen->kd_dosen)
        ->get();
        if(!$jadwal) return $this->sendError('Tidak ada matakuliah yang diampu!');
        return new ListJadwalDosenCollection($jadwal);
    }

    /**
     * Membuka sesi presensi sebuah jadwal matakuliah.
     * Digunakan untuk aplikasi mobile.
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function bukaSesiPresensi(Jadwal $jadwal)
    {
        if($jadwal==null) return $this->sendError('Data jadwal tidak ditemukan!');
        if($jadwal->sesi_presensi_dibuka == true) return $this->sendError('Sesi presensi telah dibuka!');
        // Mengambil waktu sekarang
        $date = Carbon::now()->timezone('Asia/Jakarta');
        $tanggal_sekarang = $date->format('Y-m-d');
        $jam_sekarang = $date->format('H:i:s');
        $kd_hari = $date->dayOfWeek;

        // Mencari data berita acara
        $berita_acara = BeritaAcara::where('kd_jadwal',$jadwal->kd_jadwal)
        ->where('tgl_pertemuan', $tanggal_sekarang)->get();
        if($berita_acara->first()!=null) return $this->sendError('Berita acara telah diisi!');

        // Mengambil data jam mulai dan berakhir jadwal matakuliah 
        $sesi_mulai = Sesi::find($jadwal->kd_sesi_mulai);
        $sesi_berakhir = Sesi::find($jadwal->kd_sesi_berakhir);
        $jam_mulai = $sesi_mulai->jam_mulai;
        $jam_berakhir = $sesi_berakhir->jam_berakhir;

        // Konversi ke bentuk waktu
        $jam_sekarang = Carbon::createFromFormat('H:i:s', $jam_sekarang, 'Asia/Jakarta');
        $jam_mulai = Carbon::createFromFormat('H:i:s', $jam_mulai, 'Asia/Jakarta');
        $jam_berakhir = Carbon::createFromFormat('H:i:s',$jam_berakhir, 'Asia/Jakarta');

        // Validasi waktu presensi dibuka
        if($kd_hari!=$jadwal->kd_hari){
            return $this->sendError('Hari perkuliahan belum dimulai!');
        }else if($jam_sekarang->lessThan($jam_mulai)){
            return $this->sendError('Waktu perkuliahan belum dimulai!');
        }else if($jam_sekarang->greaterThanOrEqualTo($jam_berakhir)){
            return $this->sendError('Waktu perkuliahan telah berakhir!');
        }

        // Melakukan inisialisasi absensi kelas
        $mhs_kelas = Mahasiswa::where('kd_kelas', $jadwal->kd_kelas)->get();
        $jumlah_sesi = $jadwal->kd_sesi_berakhir - $jadwal->kd_sesi_mulai;
        $jumlah_sesi = $jumlah_sesi + 1;
        $data_sesi_hilang = array();
        $presensi_kelas = array();
        foreach($mhs_kelas as $mhs){
            $kehadiran = Kehadiran::where('nim',$mhs->nim)
            ->where('kd_jadwal', $jadwal->kd_jadwal)
            ->where('tgl_presensi', $tanggal_sekarang)
            ->get();
            if($kehadiran->count()==0){ // Jika data kehadiran masih kosong
                for($sesi = $jadwal->kd_sesi_mulai;
                    $sesi <= $jadwal->kd_sesi_berakhir;
                    $sesi++){
                    $data_presensi['nim'] = $mhs->nim;
                    $data_presensi['kd_jadwal'] = $jadwal->kd_jadwal;
                    $data_presensi['kd_sesi'] = $sesi;
                    $data_presensi['kd_status_presensi'] = 'A';
                    $data_presensi['tgl_presensi'] = $tanggal_sekarang;
                    $data_presensi['jam_presensi'] = $jam_sekarang->format('H:i:s');
                    $data_presensi['jam_presensi_dibuka'] = $jam_sekarang->format('H:i:s');
                    $presensi_kelas[] = $data_presensi;
                }
            }else if($kehadiran->count() < $jumlah_sesi){ // Jika data kehadiran kurang
                $sesi_hilang = array();
                $missing = 0;
                $found = false;
                for($sesi = $jadwal->kd_sesi_mulai;
                    $sesi <= $jadwal->kd_sesi_berakhir;
                    $sesi++){                    
                    foreach($kehadiran as $data_hadir){
                        if(intval($data_hadir->kd_sesi) == $sesi){
                            $found = true;
                            $missing = 0;
                            break;
                        }else{
                            $found = false;
                            $missing = $sesi;
                        }
                    }
                    if((!$found) && ($missing!=0)){
                        $sesi_hilang[] = $missing;
                    }
                }
                foreach($sesi_hilang as $data_sesi){
                    $data_presensi['nim'] = $mhs->nim;
                    $data_presensi['kd_jadwal'] = $jadwal->kd_jadwal;
                    $data_presensi['kd_sesi'] = $data_sesi;
                    $data_presensi['kd_status_presensi'] = 'A';
                    $data_presensi['tgl_presensi'] = $tanggal_sekarang;
                    $data_presensi['jam_presensi'] = $jam_sekarang->format('H:i:s');
                    $data_presensi['jam_presensi_dibuka'] = $jam_sekarang->format('H:i:s');
                    $data_sesi_hilang[] = $data_presensi;
                }
            }
        }
        if(count($data_sesi_hilang)!=0) Kehadiran::insert($data_sesi_hilang);
        if(count($presensi_kelas)!=0) Kehadiran::insert($presensi_kelas);

        // Update status sesi presensi
        $jadwal->sesi_presensi_dibuka = true;
        $jadwal->jam_presensi_dibuka = $jam_sekarang->format('H:i:s');
        $jadwal->jam_presensi_ditutup = null;
        $jadwal->update();
        return $this->sendResponse([
            'jadwal' => $jadwal
        ], 'Berhasil membuka sesi presensi!');
    }

    /**
     * Membuka sesi presensi sebuah jadwal matakuliah.
     * Digunakan untuk aplikasi mobile.
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function tutupSesiPresensi(Jadwal $jadwal)
    {
        if($jadwal==null) return $this->sendError('Data jadwal tidak ditemukan!');
        if($jadwal->sesi_presensi_dibuka == false) return $this->sendError('Sesi presensi telah ditutup!');

        // Mengambil waktu sekarang
        $date = Carbon::now()->timezone('Asia/Jakarta');
        $jam_sekarang = $date->format('H:i:s');

        // Tutup sesi presensi
        $jadwal->sesi_presensi_dibuka = false;
        $jadwal->jam_presensi_ditutup = $jam_sekarang;
        $jadwal->update();

        return $this->sendResponse([
            'jadwal' => $jadwal
        ], 'Berhasil menutup sesi presensi!');
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
            'unique' => 'Atribut :attribute harus bersifat unik.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'gte' => [
                'numeric' => 'Atribut :attribute harus memiliki nilai sama dengan atau lebih besar dari :value.',
            ],
            'in' => 'Attribut :attribute harus berupa Teori / Praktek.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
        ];
        $validator = Validator::make($request->all(), [
            'kd_kelas' => 'required|exists:App\Kelas,kd_kelas',
            'kd_hari' => 'required|numeric|exists:App\Hari,kd_hari',
            'kd_sesi_mulai' => 'required|numeric|exists:App\Sesi,kd_sesi',
            'kd_sesi_berakhir' => 'required|numeric|exists:App\Sesi,kd_sesi|gte:kd_sesi_mulai',
            'kd_ruang' => 'required|exists:App\Ruang,kd_ruang',
            'kd_matakuliah' => 'required|exists:App\Matakuliah,kd_matakuliah',
            'kd_dosen_pengajar' => 'required|exists:App\Dosen,kd_dosen',
            'jenis_perkuliahan' => [
                'required',
                Rule::in(['Teori', 'Praktek']),
            ],
            'sesi_presensi_dibuka' => 'boolean',
            'toleransi_keterlambatan' => 'numeric|gte:10',
            'jam_presensi_dibuka' => 'date_format:H:i:s',
            'jam_presensi_ditutup' => 'date_format:H:i:s|after_or_equal:jam_presensi_dibuka'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $temp_jadwal = Jadwal::all()->last();
        $kd_jadwal = "Jadwal0001";
        if($temp_jadwal) $kd_jadwal = ++$temp_jadwal->kd_jadwal;

        $kelas = Kelas::find($request->kd_kelas);
        if(!$kelas) return $this->sendError('Data kelas tidak ditemukan!');

        $hari = Hari::find($request->kd_hari);
        if(!$hari) return $this->sendError('Data hari tidak ditemukan!');

        $sesiMulai = Sesi::find($request->kd_sesi_mulai);
        if(!$sesiMulai) return $this->sendError('Data sesi tidak ditemukan!');

        $sesiBerakhir = Sesi::find($request->kd_sesi_berakhir);
        if(!$sesiBerakhir) return $this->sendError('Data sesi tidak ditemukan!');

        $ruang = Ruang::find($request->kd_ruang);
        if(!$ruang) return $this->sendError('Data ruang tidak ditemukan!');

        $matakuliah = Matakuliah::find($request->kd_matakuliah);
        if(!$matakuliah) return $this->sendError('Matakuliah tidak ditemukan!');

        $dosen = Dosen::find($request->kd_dosen_pengajar);
        if(!$dosen) return $this->sendError('Data dosen tidak ditemukan!');
        
        $jadwal = new Jadwal;
        $jadwal->kd_jadwal = $kd_jadwal;
        $jadwal->jenis_perkuliahan = $request->jenis_perkuliahan;
        if($request->sesi_presensi_dibuka!=null) $jadwal->sesi_presensi_dibuka = $request->sesi_presensi_dibuka;
        if($request->jam_presensi_dibuka!=null) $jadwal->jam_presensi_dibuka = $request->jam_presensi_dibuka;
        if($request->jam_presensi_ditutup!=null) $jadwal->jam_presensi_ditutup = $request->jam_presensi_ditutup;
        if($request->toleransi_keterlambatan!=null){
            $jadwal->toleransi_keterlambatan = $request->toleransi_keterlambatan;
        }else{
            $jadwal->toleransi_keterlambatan = 10;
        }
        $jadwal->kelas()->associate($kelas);
        $jadwal->hari()->associate($hari);
        $jadwal->sesiMulai()->associate($sesiMulai);
        $jadwal->sesiBerakhir()->associate($sesiBerakhir);
        $jadwal->ruang()->associate($ruang);
        $jadwal->matakuliah()->associate($matakuliah);
        $jadwal->dosen()->associate($dosen);
        $jadwal->save();
        return $this->sendResponse([
            'jadwal' => [new JadwalResource($jadwal)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        if($jadwal) return $this->sendResponse([
            'jadwal' => new JadwalResource($jadwal)
        ],'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'alpha' => 'Atribut :attribute hanya boleh berupa alfabet.',
            'unique' => 'Atribut :attribute harus bersifat unik.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'gte' => [
                'numeric' => 'Atribut :attribute harus memiliki nilai sama dengan atau lebih besar dari :value.',
            ],
            'in' => 'Attribut :attribute harus berupa Teori / Praktek.',
            'boolean' => 'Atribut \':attribute\' hanya boleh bernilai true / false',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
        ];
        $validator = Validator::make($request->all(), [
            'kd_jadwal' => 'required|exists:App\Jadwal,kd_jadwal',
            'kd_kelas' => 'required|exists:App\Kelas,kd_kelas',
            'kd_hari' => 'required|numeric|exists:App\Hari,kd_hari',
            'kd_sesi_mulai' => 'required|numeric|exists:App\Sesi,kd_sesi',
            'kd_sesi_berakhir' => 'required|numeric|exists:App\Sesi,kd_sesi|gte:kd_sesi_mulai',
            'kd_ruang' => 'required|exists:App\Ruang,kd_ruang',
            'kd_matakuliah' => 'required|exists:App\Matakuliah,kd_matakuliah',
            'kd_dosen_pengajar' => 'required|exists:App\Dosen,kd_dosen',
            'jenis_perkuliahan' => [
                'required',
                Rule::in(['Teori', 'Praktek']),
            ],
            'sesi_presensi_dibuka' => 'boolean',
            'toleransi_keterlambatan' => 'numeric|gte:10',
            'jam_presensi_dibuka' => 'date_format:H:i:s',
            'jam_presensi_ditutup' => 'date_format:H:i:s|after_or_equal:jam_presensi_dibuka'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $kelas = Kelas::find($request->kd_kelas);
        if(!$kelas) return $this->sendError('Data kelas tidak ditemukan!');

        $hari = Hari::find($request->kd_hari);
        if(!$hari) return $this->sendError('Data hari tidak ditemukan!');

        $sesiMulai = Sesi::find($request->kd_sesi_mulai);
        if(!$sesiMulai) return $this->sendError('Data sesi tidak ditemukan!');

        $sesiBerakhir = Sesi::find($request->kd_sesi_berakhir);
        if(!$sesiBerakhir) return $this->sendError('Data sesi tidak ditemukan!');

        $ruang = Ruang::find($request->kd_ruang);
        if(!$ruang) return $this->sendError('Data ruang tidak ditemukan!');

        $matakuliah = Matakuliah::find($request->kd_matakuliah);
        if(!$matakuliah) return $this->sendError('Matakuliah tidak ditemukan!');

        $dosen = Dosen::find($request->kd_dosen_pengajar);
        if(!$dosen) return $this->sendError('Data dosen tidak ditemukan!');
        
        $jadwal->jenis_perkuliahan = $request->jenis_perkuliahan;
        if($request->sesi_presensi_dibuka!=null) $jadwal->sesi_presensi_dibuka = $request->sesi_presensi_dibuka;
        if($request->toleransi_keterlambatan!=null) $jadwal->toleransi_keterlambatan = $request->toleransi_keterlambatan;
        if($request->jam_presensi_dibuka) $jadwal->jam_presensi_dibuka = $request->jam_presensi_dibuka;
        if($request->jam_presensi_ditutup) $jadwal->jam_presensi_ditutup = $request->jam_presensi_ditutup;
        $jadwal->kelas()->associate($kelas);
        $jadwal->hari()->associate($hari);
        $jadwal->sesiMulai()->associate($sesiMulai);
        $jadwal->sesiBerakhir()->associate($sesiBerakhir);
        $jadwal->ruang()->associate($ruang);
        $jadwal->matakuliah()->associate($matakuliah);
        $jadwal->dosen()->associate($dosen);
        $jadwal->update();
        return $this->sendResponse([
            'jadwal' => [new JadwalResource($jadwal)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return $this->sendResponse(null, 'Berhasil menghapus data!');
    }
}
