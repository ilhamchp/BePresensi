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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function jadwal_mahasiswa(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'exists' => 'Atribut :attribute tidak terdapat di database.'
        ];
        $validator = Validator::make($request->all(), [
            'nim' => 'required|exists:App\Mahasiswa,nim',
        ],$messages);   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));
        
        $date = Carbon::now()->timezone('Asia/Jakarta');
        $kd_hari = $date->dayOfWeek;
        $tanggal = $date->format('Y-m-d');
        $nim = $request->nim;
        $mahasiswa = Mahasiswa::find($nim);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function jadwal_dosen(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'exists' => 'Atribut :attribute tidak terdapat di database.'
        ];
        $validator = Validator::make($request->all(), [
            'kd_dosen' => 'required|exists:App\Dosen,kd_dosen',
        ],$messages);   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));
        
        $date = Carbon::now()->timezone('Asia/Jakarta');
        $kd_hari = $date->dayOfWeek;
        $tanggal = $date->format('Y-m-d');
        $kd_dosen = $request->kd_dosen;
        $jadwal = Jadwal::where('kd_dosen_pengajar','=',$kd_dosen)
        ->where('kd_hari','=',$kd_hari)
        ->with([
            'beritaAcara' => function($query) use ($tanggal){
                $query->where('tgl_pertemuan',$tanggal);
            }
        ])->get();
        if(!$jadwal) return $this->sendError('Tidak ada matakuliah hari ini!');
        return new ListJadwalDosenCollection($jadwal);
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
            'jam_presensi_dibuka' => 'date_format:H:i:s'
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
        $jadwal->sesi_presensi_dibuka = $request->sesi_presensi_dibuka;
        $jadwal->toleransi_keterlambatan = $request->toleransi_keterlambatan;
        if($request->jam_presensi_dibuka) $jadwal->jam_presensi_dibuka = $request->jam_presensi_dibuka;
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
            'jam_presensi_dibuka' => 'date_format:H:i:s'
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
