<template>
  <KelasForm
    :kelas="kelas"
    :kd_dosen="kd_wali_dosen"
    :onSubmit="updateDataKelas"
  ></KelasForm>
</template>

<script>
import KelasForm from "./KelasForm";

export default {
  components: {
    KelasForm,
  },

  data() {
    return {
      kd_wali_dosen: [],
      kelas: {
        kd_kelas: "",
        tingkat_kelas: "",
        prodi: "",
        angkatan: "",
        // kd_wali_dosen: ''
      },
    };
  },

  created() {
    this.loadDataDosen();
  },

  mounted() {
    const { kd_kelas } = this.$route.params;
    console.log(kd_kelas);
    this.load(kd_kelas);
  },

  methods: {
    load(id) {
      axios.get("http://127.0.0.1:8000/api/kelas/" + id)
      .then((kelas) => {
        console.log(kelas.data.data.kelas);
        this.kelas = kelas.data.data.kelas;
        // this.kd_wali_dosen = kelas.data.data.kelas
      });
    },

    async updateDataKelas() {
      // menampilkan loading
      this.isLoadingData = true;
      // console.log(this.form)
      // fetch data dari api menggunakan axios
      axios
        .put(
          "http://127.0.0.1:8000/api/kelas/" + this.kelas.kd_kelas,
          this.kelas
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