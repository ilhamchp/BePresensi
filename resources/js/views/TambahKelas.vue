<template>
  <KelasForm
    :kelas="kelas"
    :kd_dosen="kd_wali_dosen"
    :onSubmit="addDataKelas"
  ></KelasForm>
</template>

<script>
import KelasForm from './KelasForm';

export default {
  components: {
    KelasForm
  },

  data() {
    return {
      kd_wali_dosen: [],
      kelas: {
        kd_kelas: '',
        tingkat_kelas: '',
        prodi: '',
        angkatan: '',
        // kd_wali_dosen: ''
      },
    };
  },

  created() {
    this.loadDataDosen();
  },

  methods: {
    async addDataKelas() {
      // menampilkan loading
      this.isLoadingData = true;
      console.log(this.kelas)
      // fetch data dari api menggunakan axios
      axios
        .post("http://127.0.0.1:8000/api/kelas", this.kelas, this.kd_wali_dosen)
        .then((response) => {
          // mengirim data hasil fetch ke varibale array beacon
          this.load();
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
          this.kd_wali_dosen = response.data.data.dosen;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },
  },
};
</script>