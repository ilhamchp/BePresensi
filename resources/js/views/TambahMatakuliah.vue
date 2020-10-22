<template>
  <MatakuliahForm
    :matakuliah="matakuliah"
    :onSubmit="addDataMatkul"
  ></MatakuliahForm>
</template>

<script>
import MatakuliahForm from "./MatakuliahForm";

export default {
  components: {
    MatakuliahForm,
  },

  data() {
    return {
      matakuliah: {
        nama_matakuliah: "",
        kd_matakuliah: "",
      },
    };
  },
  // created() {
  //     this.loadDataMatkul();
  //     document.title = "Matakuliah | BePresensi";
  // },
  methods: {
    async addDataMatkul() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .post("http://127.0.0.1:8000/api/matakuliah", this.matakuliah)
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