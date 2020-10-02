import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './views/Home.vue'
import Beacon from './views/Beacon.vue'
import Dosen from './views/Dosen.vue'
import JadwalMatakuliah from './views/JadwalMatakuliah.vue'
import Kelas from './views/Kelas.vue'
import Mahasiswa from './views/Mahasiswa.vue'
import Matakuliah from './views/Matakuliah.vue'
import Presensi from './views/Presensi.vue'
import StaffTataUsaha from './views/StaffTataUsaha.vue'
import SuratIzin from './views/SuratIzin.vue'
import User from './views/User.vue'
import TambahMahasiswa from './views/TambahMahasiswa.vue'
import TambahBeacon from './views/TambahBeacon.vue'
import TambahDosen from './views/TambahDosen.vue'
import TambahKelas from './views/TambahKelas.vue'
import TambahMatakuliah from './views/TambahMatakuliah.vue'
import TambahUser from './views/TambahUser.vue'
import TambahStaffTU from './views/TambahStaffTU.vue'
import TambahSuratIzin from './views/TambahSuratIzin.vue'
import EditMatakuliah from './views/EditMatakuliah.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', name: 'home', component: Home},
        { path: '/beacon', name: 'beacon', component: Beacon},
        { path: '/dosen', name: 'dosen', component: Dosen},
        { path: '/jadwal-matakuliah', name: 'jadwal-matakuliah', component: JadwalMatakuliah},
        { path: '/kelas', name: 'kelas', component: Kelas},
        { path: '/mahasiswa', name: 'mahasiswa', component: Mahasiswa},
        { path: '/matakuliah', name: 'matakuliah', component: Matakuliah},
        { path: '/presensi', name: 'presensi', component: Presensi},
        { path: '/staff-tata-usaha', name: 'staff-tata-usaha', component: StaffTataUsaha},
        { path: '/surat-izin', name: 'surat-izin', component: SuratIzin},
        { path: '/user', name: 'user', component: User},
        { path: '/tambah-mahasiswa', name: 'tambah-mahasiswa', component: TambahMahasiswa},
        { path: '/tambah-beacon', name: 'tambah-beacon', component: TambahBeacon},
        { path: '/tambah-dosen', name: 'tambah-dosen', component: TambahDosen},
        { path: '/tambah-kelas', name: 'tambah-kelas', component: TambahKelas},
        { path: '/tambah-matakuliah', name: 'tambah-matakuliah', component: TambahMatakuliah},
        { path: '/tambah-user', name: 'tambah-user', component: TambahUser},
        { path: '/tambah-stafftu', name: 'tambah-stafftu', component: TambahStaffTU},
        { path: '/tambah-surat-izin', name: 'tambah-surat-izin', component: TambahSuratIzin},
        { path: '/edit-matakuliah/:kd_matakuliah', name: 'edit-matakuliah', component: EditMatakuliah}
    ]
})

export default router
