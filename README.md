# BePresensi

BePresensi adalah sistem presensi online pada Jurusan Teknik Komputer dan Informatika Politenik Negeri Bandung. Sistem ini memungkinkan untuk melakukan seluruh proses presensi hingga perekapan secara daring dan terotomatisasi. Pengguna dari sistem ini adalah Mahasiswa, Dosen Pengajar, Wali Dosen, dan Staf Tata Usaha JTK POLBAN. Fitur aplikasi ini diantaranya adalah:
- Melakukan proses presensi secara online
- Perekapan dan penyebaran rekap secara otomatis
- Mengurangi kemungkinan tipsen dengan bantuan hardware Beacon
- Pengiriman surat izin / sakit / dispensasi secara online

Sistem ini dibuat dalam rangka untuk penyelesaian Tugas Akhir.

## BePresensi Mobile

BePresensi mobile dibangun pada platform Android. Aplikasi ini ditujukan untuk Mahasiswa, Dosen Pengajar, Wali Dosen. Fitur yang dapat diakses pada aplikasi ini dibagi sesuai dengan role sebagai berikut.

Mahasiswa:
- Melakukan presensi
- Melihat riwayat presensi 7 hari terakhir
- Mengirim dan melihat status surat izin / sakit / dispensasi
- Melihat akumulasi jam ketidakhadiran sakit, izin dan alfa.
- Melihat status presensi

Dosen Pengajar:
- Membuka dan menutup sesi presensi
- Melihat dan merubah daftar presensi mahasiswa
- Mengisi berita acara perkuliahan
- Mengatur toleransi keterlambatan presensi

Wali Dosen:
- Seluruh fitur Dosen Pengajar
- Malihat dan menyetujui surat yang diajukan mahasiswa

## BePresensi Web

BePresensi Web dibangun menggunakan Vue JS. Aplikasi ini ditujukan untuk Staf Tata Usaha. Fitur yang dapat diakses pada aplikasi ini adalah :
- Mengolah data mahasiswa
- Mengolah data dosen
- Mengolah data kelas
- Mengolah data jadwal
- Mengolah data beacon
- Mengolah data surat
- Mengolah data presensi
- Mengolah data akses login aplikasi BePresensi Mobile

## Tutorial Install BePresensi Web

1. Clone project ini
2. Buka folder project ini
3. Rename file `.env.example` menjadi `.env`
4. Buat database dengan nama `kota205_bepresensi`
5. Buka command prompt / terminal dan arahkan ke folder project ini
6. Jalankan perintah `composer install` dan tunggu hingga berhasil
7. Jalankan perintah `php artisan migrate:refresh --seed` dan tunggu hingga berhasil

### Credit

Aplikasi ini dibuat oleh:
- **[Ilham Cahyahadi Pamungkas](mailto:ilhamchp@gmail.com)**
- **[Kovalevshero Al Fayyad Yafiano](mailto:heroa7x@gmail.com)**
