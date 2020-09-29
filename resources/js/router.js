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
import TambahEditMahasiswa from './views/TambahEditMahasiswa.vue'
import TambahEditBeacon from './views/TambahEditBeacon.vue'
import TambahEditDosen from './views/TambahEditDosen.vue'
import TambahEditKelas from './views/TambahEditKelas.vue'
import TambahEditMatakuliah from './views/TambahEditMatakuliah.vue'
import TambahUser from './views/TambahUser.vue'

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
        { path: '/tambah-edit-mahasiswa', name: 'tambah-edit-mahasiswa', component: TambahEditMahasiswa},
        { path: '/tambah-edit-beacon', name: 'tambah-edit-beacon', component: TambahEditBeacon},
        { path: '/tambah-edit-dosen', name: 'tambah-edit-dosen', component: TambahEditDosen},
        { path: '/tambah-edit-kelas', name: 'tambah-edit-kelas', component: TambahEditKelas},
        { path: '/tambah-edit-matakuliah', name: 'tambah-edit-matakuliah', component: TambahEditMatakuliah},
        { path: '/tambah-user', name: 'tambah-user', component: TambahUser},
    ]
})

export default router
