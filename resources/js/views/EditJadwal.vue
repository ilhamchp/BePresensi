<template>
  <JadwalForm
    :jadwal="jadwal"
    :kd_kelas="kd_kelas"
    :kd_hari="kd_hari"
    :kd_sesi="kd_sesi_mulai"
    :kd_ruang="kd_ruang"
    :kd_matakuliah="kd_matakuliah"
    :kd_dosen="kd_dosen_pengajar"
    :jenis_perkuliahan="jenis_perkuliahan"
    :onSubmit="updateDataJadwal"
  ></JadwalForm>
</template>

<script>
import JadwalForm from "./JadwalForm";

export default {
  components: {
    JadwalForm,
  },

  data() {
    return {
      kd_kelas: [],
      kd_hari: [],
      kd_sesi_mulai: [],
      kd_sesi_berakhir: [],
      kd_ruang: [],
      kd_matakuliah: [],
      kd_dosen_pengajar: [],
      jenis_perkuliahan: ["Teori", "Praktek"],
      jadwal: {
        toleransi_keterlambatan: "",
        // sesi_presensi_dibuka: "",
        // jam_presensi_dibuka: "",
        // jam_presensi_ditutup: "",
      },
    };
  },
  created() {
    this.loadDataKelas();
    this.loadDataHari();
    this.loadDataSesi();
    this.loadDataRuang();
    this.loadDataMatakuliah();
    this.loadDataDosen();
  },
  mounted() {
    const { kd_jadwal } = this.$route.params;
    console.log(kd_jadwal);
    this.load(kd_jadwal);
  },
  methods: {
    load(id) {
      axios
      .get("http://127.0.0.1:8000/api/jadwal/" + id)
      .then((jadwal) => {
        console.log(jadwal.data.data.jadwal);
        this.jadwal = jadwal.data.data.jadwal;
        // this.kd_sesi_mulai = jadwal.data.data.jadwal.kd_sesi_mulai;
        // this.kd_sesi_berakhir = jadwal.data.data.jadwal.kd_sesi_berakhir;
      });
    },

    async loadDataKelas() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/kelas")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array surat izin
          this.kd_kelas = response.data.data.kelas;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    async loadDataHari() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/hari")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array surat izin
          this.kd_hari = response.data.data.hari;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    async loadDataSesi() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/sesi")
        .then((response) => {
          this.kd_sesi_mulai = response.data.data.sesi;
          this.kd_sesi_berakhir = response.data.data.sesi;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    async loadDataRuang() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/ruang")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array surat izin
          this.kd_ruang = response.data.data.ruang;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    async loadDataMatakuliah() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/matakuliah")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array surat izin
          this.kd_matakuliah = response.data.data.matakuliah;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    async loadDataDosen() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/dosen")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array surat izin
          this.kd_dosen_pengajar = response.data.data.dosen;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    async updateDataJadwal() {
      // menampilkan loading
      this.isLoadingData = true;
      console.log(this.jadwal);

      // fetch data dari api menggunakan axios
      // axios
      //   .put(
      //     "http://127.0.0.1:8000/api/jadwal/" + this.jadwal.kd_jadwal,
      //     this.jadwal,
      //     this.kd_kelas,
      //     this.kd_hari,
      //     this.kd_sesi_mulai,
      //     this.kd_sesi_berakhir,
      //     this.kd_ruang,
      //     this.kd_matakuliah,
      //     this.kd_dosen_pengajar
      //   )
      //   .then((response) => {
      //     console.log(response.data);
      //     this.message = "The data was updated successfully!";
      //   })
      //   .catch((e) => {
      //     console.log(e);
      //   })
      //   .finally(() => {
      //     // mengakhiri loading
      //     this.isLoadingData = false;
      //   });
    },
  },
};
</script>