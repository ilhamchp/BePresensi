<template>
  <MahasiswaForm
    :mahasiswa="mahasiswa"
    :id_user="id_user"
    :kd_kelas="kd_kelas"
    :onSubmit="updateDataMahasiswa"
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

  mounted() {
    const { nim } = this.$route.params;
    console.log(nim);
    this.load(nim);
  },

  methods: {
    load(id) {
      axios
        .get("http://127.0.0.1:8000/api/mahasiswa/" + id)
        .then((mahasiswa) => {
          console.log(mahasiswa.data.data.mahasiswa);
          this.mahasiswa = mahasiswa.data.data.mahasiswa;
        });
    },

    async loadDataUser() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/user")
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

    async updateDataMahasiswa() {
      // menampilkan loading
      this.isLoadingData = true;
      // console.log(this.form)

      // fetch data dari api menggunakan axios
      axios
        .put(
          "http://127.0.0.1:8000/api/mahasiswa/" + this.mahasiswa.nim,
          this.mahasiswa,
          this.id_user,
          this.kd_kelas
        )
        .then((response) => {
          console.log(response.data);
          this.message = "The data was updated successfully!";
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