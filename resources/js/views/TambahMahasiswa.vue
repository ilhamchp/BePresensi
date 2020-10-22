<template>
  <MahasiswaForm
    :mahasiswa="mahasiswa"
    :id_user="id_user"
    :kd_kelas="kd_kelas"
    :onSubmit="addDataMahasiswa"
  ></MahasiswaForm>
</template>

<script>
import MahasiswaForm from "./MahasiswaForm";

export default {
  components: {
    MahasiswaForm,
  },

  data() {
    return {
      id_user: [],
      kd_kelas: [],
      mahasiswa: {
        nim: "",
        nama_mahasiswa: "",
        foto_mahasiswa: "",
      },
    };
  },

  created() {
    this.loadDataUser();
    this.loadDataKelas();
  },

  methods: {
    async loadDataUser() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/dropdown-user")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array surat izin
          this.id_user = response.data.data.user;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
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

    async addDataMahasiswa() {
      // menampilkan loading
      this.isLoadingData = true;
      // console.log(this.form)

      // fetch data dari api menggunakan axios
      axios
        .post(
          "http://127.0.0.1:8000/api/mahasiswa",
          this.mahasiswa,
          this.id_user,
          this.kd_kelas
        )
        .then((response) => {
          // mengirim data hasil fetch ke varibale array matakuliah
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
  },
};
</script>