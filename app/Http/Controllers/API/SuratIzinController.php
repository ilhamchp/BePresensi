<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\SuratIzin;
use Illuminate\Http\Request;
use App\Http\Resources\SuratIzinCollection;
use App\Http\Resources\SuratIzin as SuratIzinResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\StatusPresensiCollection;
use App\Http\Resources\MahasiswaCollection;
use App\Http\Resources\StatusSuratCollection;
use App\StatusPresensi;
use App\Mahasiswa;
use App\StatusSurat;
use App\Kelas;
use App\Dosen;

class SuratIzinController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SuratIzinCollection(SuratIzin::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
            'alpha' => 'Atribut :attribute harus berupa alfabet.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_jenis_izin' => 'required|alpha|exists:App\StatusPresensi,kd_status_presensi',
            'nim'=> 'required|exists:App\Mahasiswa,nim',
            'tgl_mulai' => 'required|date_format:Y-n-j',
            'tgl_selesai' => 'required|date_format:Y-n-j|after_or_equal:tgl_mulai',
            'jam_mulai' => 'date_format:H:i:s',
            'jam_selesai' => 'date_format:H:i:s',
            'status_surat' => 'required|numeric|exists:App\StatusSurat,kd_status_surat',
            'foto_surat' => 'required|unique:App\SuratIzin,foto_surat'
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        $jenis_izin = StatusPresensi::find($request->kd_jenis_izin);
        if(!$jenis_izin) return $this->sendError('Data jenis izin tidak ditemukan!');

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        $status_surat = StatusSurat::find($request->status_surat);
        if(!$status_surat) return $this->sendError('Data status surat tidak ditemukan!');

        $temp_surat = SuratIzin::all()->last();
        $kd_surat_izin = 'SuratIzin0001';
        if($temp_surat) $kd_surat_izin = ++$temp_surat->kd_surat_izin; 
        
        $suratIzin = new SuratIzin;
        $suratIzin->kd_surat_izin = $kd_surat_izin;
        $suratIzin->tgl_mulai = $request->tgl_mulai;
        $suratIzin->tgl_selesai = $request->tgl_selesai;
        if($request->jam_mulai) $suratIzin->jam_mulai = $request->jam_mulai;
        if($request->jam_selesai) $suratIzin->jam_selesai = $request->jam_selesai;
        if($request->catatan_surat) $suratIzin->catatan_surat = $request->catatan_surat;
        if($request->catatan_wali_dosen) $suratIzin->catatan_wali_dosen = $request->catatan_wali_dosen;
        $suratIzin->foto_surat = $request->foto_surat;
        $suratIzin->jenisIzin()->associate($jenis_izin);
        $suratIzin->mahasiswa()->associate($mahasiswa);
        $suratIzin->statusSurat()->associate($status_surat);
        $suratIzin->save();
        return $this->sendResponse([
            'surat_izin' => new SuratIzinResource($suratIzin)
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuratIzin  $suratIzin
     * @return \Illuminate\Http\Response
     */
    public function show(SuratIzin $suratIzin)
    {
        if($suratIzin) return $this->sendResponse([
            'surat_izin' => new SuratIzinResource($suratIzin)
        ], 'success');
        return $this->sendError('Data surat izin tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratIzin  $suratIzin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratIzin $suratIzin)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
            'alpha' => 'Atribut :attribute harus berupa alfabet.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_surat_izin' => 'required|exists:App\SuratIzin,kd_surat_izin',
            'kd_jenis_izin' => 'required|alpha|exists:App\StatusPresensi,kd_status_presensi',
            'nim'=> 'required|exists:App\Mahasiswa,nim',
            'tgl_mulai' => 'required|date_format:Y-n-j',
            'tgl_selesai' => 'required|date_format:Y-n-j|after_or_equal:tgl_mulai',
            'jam_mulai' => 'date_format:H:i:s',
            'jam_selesai' => 'date_format:H:i:s',
            'status_surat' => 'required|numeric|exists:App\StatusSurat,kd_status_surat',
            'foto_surat' => 'required'
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        $jenis_izin = StatusPresensi::find($request->kd_jenis_izin);
        if(!$jenis_izin) return $this->sendError('Data jenis izin tidak ditemukan!');

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        $status_surat = StatusSurat::find($request->status_surat);
        if(!$status_surat) return $this->sendError('Data status surat tidak ditemukan!');

        $suratIzin->tgl_mulai = $request->tgl_mulai;
        $suratIzin->tgl_selesai = $request->tgl_selesai;
        if($request->jam_mulai) $suratIzin->jam_mulai = $request->jam_mulai;
        if($request->jam_selesai) $suratIzin->jam_selesai = $request->jam_selesai;
        if($request->catatan_surat) $suratIzin->catatan_surat = $request->catatan_surat;
        if($request->catatan_wali_dosen) $suratIzin->catatan_wali_dosen = $request->catatan_wali_dosen;
        $suratIzin->foto_surat = $request->foto_surat;
        $suratIzin->jenisIzin()->associate($jenis_izin);
        $suratIzin->mahasiswa()->associate($mahasiswa);
        $suratIzin->statusSurat()->associate($status_surat);
        $suratIzin->update();
        return $this->sendResponse([
            'surat_izin' => new SuratIzinResource($suratIzin)
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratIzin  $suratIzin
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratIzin $suratIzin)
    {
        $suratIzin->delete();
        return $this->sendResponse(null, 'Berhasil menghapus data!');
    }

    /**
     * Mengajukan surat izin ketidakhadiran mahasiswa.
     * Digunakan untuk aplikasi mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajukanSuratIzin(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
            'alpha' => 'Atribut :attribute harus berupa alfabet.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
        ];
        $validator = Validator::make($request->all(), [
            'nim'=> 'required|exists:App\Mahasiswa,nim',
            'tgl_mulai' => 'required|date_format:Y-n-j',
            'tgl_selesai' => 'required|date_format:Y-n-j|after_or_equal:tgl_mulai',
            'jam_mulai' => 'date_format:H:i:s',
            'jam_selesai' => 'date_format:H:i:s',
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        // Jenis surat = Izin
        $jenis_izin = StatusPresensi::find('I');
        if(!$jenis_izin) return $this->sendError('Data jenis izin tidak ditemukan!');

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        // Status surat = Diajukan
        $status_surat = StatusSurat::find(1);
        if(!$status_surat) return $this->sendError('Data status surat tidak ditemukan!');

        $temp_surat = SuratIzin::all()->last();
        $kd_surat_izin = 'SuratIzin0001';
        if($temp_surat) $kd_surat_izin = ++$temp_surat->kd_surat_izin; 
        
        $suratIzin = new SuratIzin;
        $suratIzin->kd_surat_izin = $kd_surat_izin;
        $suratIzin->tgl_mulai = $request->tgl_mulai;
        $suratIzin->tgl_selesai = $request->tgl_selesai;
        if($request->jam_mulai) $suratIzin->jam_mulai = $request->jam_mulai;
        if($request->jam_selesai) $suratIzin->jam_selesai = $request->jam_selesai;
        if($request->catatan_surat) $suratIzin->catatan_surat = $request->catatan_surat;
        $suratIzin->foto_surat = $kd_surat_izin . ".jpg";
        $suratIzin->jenisIzin()->associate($jenis_izin);
        $suratIzin->mahasiswa()->associate($mahasiswa);
        $suratIzin->statusSurat()->associate($status_surat);
        $suratIzin->save();
        return $this->sendResponse([
            'surat_izin' => new SuratIzinResource($suratIzin)
        ], 'Berhasil mengajukan surat izin!');
    }

    /**
     * Mengajukan surat dispen mahasiswa.
     * Digunakan untuk aplikasi mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajukanSuratDispen(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
            'alpha' => 'Atribut :attribute harus berupa alfabet.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
        ];
        $validator = Validator::make($request->all(), [
            'nim'=> 'required|exists:App\Mahasiswa,nim',
            'tgl_mulai' => 'required|date_format:Y-n-j',
            'tgl_selesai' => 'required|date_format:Y-n-j|after_or_equal:tgl_mulai',
            'jam_mulai' => 'date_format:H:i:s',
            'jam_selesai' => 'date_format:H:i:s',
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        // Jenis surat = Dispen
        $jenis_izin = StatusPresensi::find('D');
        if(!$jenis_izin) return $this->sendError('Data jenis izin tidak ditemukan!');

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        // Status surat = Diajukan
        $status_surat = StatusSurat::find(1);
        if(!$status_surat) return $this->sendError('Data status surat tidak ditemukan!');

        $temp_surat = SuratIzin::all()->last();
        $kd_surat_izin = 'SuratIzin0001';
        if($temp_surat) $kd_surat_izin = ++$temp_surat->kd_surat_izin; 
        
        $suratIzin = new SuratIzin;
        $suratIzin->kd_surat_izin = $kd_surat_izin;
        $suratIzin->tgl_mulai = $request->tgl_mulai;
        $suratIzin->tgl_selesai = $request->tgl_selesai;
        if($request->jam_mulai) $suratIzin->jam_mulai = $request->jam_mulai;
        if($request->jam_selesai) $suratIzin->jam_selesai = $request->jam_selesai;
        $suratIzin->foto_surat = $kd_surat_izin . ".jpg";
        if($request->catatan_surat) $suratIzin->catatan_surat = $request->catatan_surat;
        $suratIzin->jenisIzin()->associate($jenis_izin);
        $suratIzin->mahasiswa()->associate($mahasiswa);
        $suratIzin->statusSurat()->associate($status_surat);
        $suratIzin->save();
        return $this->sendResponse([
            'surat_izin' => new SuratIzinResource($suratIzin)
        ], 'Berhasil mengajukan surat dispen!');
    }

    /**
     * Mengajukan surat dispen mahasiswa.
     * Digunakan untuk aplikasi mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajukanSuratSakit(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'numeric' => 'Atribut :attribute hanya boleh berupa angka.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
            'after_or_equal' => 'Attribut :attribute tidak boleh lebih kecil dari :date',
            'alpha' => 'Atribut :attribute harus berupa alfabet.',
            'date_format' => 'Atribut :attribute harus dalam format :format.',
        ];
        $validator = Validator::make($request->all(), [
            'nim'=> 'required|exists:App\Mahasiswa,nim',
            'tgl_mulai' => 'required|date_format:Y-n-j',
            'tgl_selesai' => 'required|date_format:Y-n-j|after_or_equal:tgl_mulai',
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        // Jenis surat = Sakit
        $jenis_izin = StatusPresensi::find('S');
        if(!$jenis_izin) return $this->sendError('Data jenis izin tidak ditemukan!');

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        // Status surat = Diajukan
        $status_surat = StatusSurat::find(1);
        if(!$status_surat) return $this->sendError('Data status surat tidak ditemukan!');

        $temp_surat = SuratIzin::all()->last();
        $kd_surat_izin = 'SuratIzin0001';
        if($temp_surat) $kd_surat_izin = ++$temp_surat->kd_surat_izin; 
        
        $suratIzin = new SuratIzin;
        $suratIzin->kd_surat_izin = $kd_surat_izin;
        $suratIzin->tgl_mulai = $request->tgl_mulai;
        $suratIzin->tgl_selesai = $request->tgl_selesai;
        $suratIzin->foto_surat = $kd_surat_izin . ".jpg";
        if($request->catatan_surat) $suratIzin->catatan_surat = $request->catatan_surat;
        $suratIzin->jenisIzin()->associate($jenis_izin);
        $suratIzin->mahasiswa()->associate($mahasiswa);
        $suratIzin->statusSurat()->associate($status_surat);
        $suratIzin->save();
        return $this->sendResponse([
            'surat_izin' => new SuratIzinResource($suratIzin)
        ], 'Berhasil mengajukan surat sakit!');
    }

    /**
     * Melihat daftar surat yang sudah diajukan mahasiswa.
     * Digunakan untuk aplikasi mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function daftarSuratIzinDiajukan(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
        ];
        $validator = Validator::make($request->all(), [
            'nim'=> 'required|exists:App\Mahasiswa,nim',
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        $suratIzin = SuratIzin::where('nim', $request->nim)->where('kd_status_surat',1)->get();
        return new SuratIzinCollection($suratIzin);
    }

    /**
     * Melihat daftar surat yang sudah diajukan mahasiswa.
     * Digunakan untuk aplikasi mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function daftarSuratIzinDiproses(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
        ];
        $validator = Validator::make($request->all(), [
            'nim'=> 'required|exists:App\Mahasiswa,nim',
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        $mahasiswa = Mahasiswa::find($request->nim);
        if(!$mahasiswa) return $this->sendError('Data mahasiswa tidak ditemukan!');

        $suratIzin = SuratIzin::where('nim', $request->nim)->where('kd_status_surat','!=',1)->get();
        return new SuratIzinCollection($suratIzin);
    }

    /**
     * Melihat daftar surat yang sudah diproses oleh dosen.
     * Digunakan untuk aplikasi mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function daftarSuratDiproses(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_dosen'=> 'required|exists:App\Dosen,kd_dosen',
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        $dosen = Dosen::find($request->kd_dosen);
        if(!$dosen) return $this->sendError('Data dosen tidak ditemukan!');

        $kelas = Kelas::where('kd_wali_dosen', $dosen->kd_dosen)->first();
        if($kelas == null) return $this->sendError('Anda bukan wali kelas!');

        $listSurat = new Collection();

        $listMahasiswa = Mahasiswa::where('kd_kelas', $kelas->kd_kelas)->get();
        foreach($listMahasiswa as $mahasiswa){
            $suratIzin = SuratIzin::where('nim', $mahasiswa->nim)
            ->where('kd_status_surat','!=','1')
            ->get();
            foreach($suratIzin as $surat){
                $listSurat->push($surat);
            }
        }
        return new SuratIzinCollection($listSurat);
    }

    /**
     * Melihat daftar surat yang belum diproses oleh dosen.
     * Digunakan untuk aplikasi mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function daftarSuratBelumDiproses(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_dosen'=> 'required|exists:App\Dosen,kd_dosen',
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));

        $dosen = Dosen::find($request->kd_dosen);
        if(!$dosen) return $this->sendError('Data dosen tidak ditemukan!');

        $kelas = Kelas::where('kd_wali_dosen', $dosen->kd_dosen)->first();
        if($kelas == null) return $this->sendError('Anda bukan wali kelas!');

        $listSurat = new Collection();

        $listMahasiswa = Mahasiswa::where('kd_kelas', $kelas->kd_kelas)->get();
        foreach($listMahasiswa as $mahasiswa){
            $suratIzin = SuratIzin::where('nim', $mahasiswa->nim)
            ->where('kd_status_surat','1')
            ->get();
            foreach($suratIzin as $surat){
                $listSurat->push($surat);
            }
        }
        return new SuratIzinCollection($listSurat);
    }

    /**
     * Menyetujui surat yang diajukan.
     * Digunakan untuk aplikasi mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setujuiSurat(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_surat_izin'=> 'required|exists:App\SuratIzin,kd_surat_izin',
            'catatan_wali_dosen' => 'required'
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));


        $suratIzin = SuratIzin::find($request->kd_surat_izin);
        $suratIzin->kd_status_surat = 2;
        $suratIzin->catatan_wali_dosen = $request->catatan_wali_dosen;
        $suratIzin->update();
        return $this->sendResponse([
            'surat_izin' => new SuratIzinResource($suratIzin)
        ], 'Berhasil menyetujui surat!');
    }

    /**
     * Menyetujui surat yang diajukan.
     * Digunakan untuk aplikasi mobile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tolakSurat(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'exists' => 'Atribut :attribute tidak terdapat di database.',
        ];
        $validator = Validator::make($request->all(), [
            'kd_surat_izin'=> 'required|exists:App\SuratIzin,kd_surat_izin',
            'catatan_wali_dosen' => 'required'
        ],$messages);   
        
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));


        $suratIzin = SuratIzin::find($request->kd_surat_izin);
        $suratIzin->kd_status_surat = 3;
        $suratIzin->catatan_wali_dosen = $request->catatan_wali_dosen;
        $suratIzin->update();
        return $this->sendResponse([
            'surat_izin' => new SuratIzinResource($suratIzin)
        ], 'Berhasil menolak surat!');
    }
}
