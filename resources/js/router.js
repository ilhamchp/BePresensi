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
        { path: '/user', name: 'user', component: User}
    ]
})

export default router
