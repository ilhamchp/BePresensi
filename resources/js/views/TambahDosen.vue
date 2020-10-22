<template>
  <DosenForm
    :dosen="dosen"
    :id_user="id_user"
    :onSubmit="addDataDosen"
  ></DosenForm>
</template>

<script>
import DosenForm from "./DosenForm";

export default {
  components: {
    DosenForm,
  },

  data() {
    return {
      id_user: [],
      dosen: {
        kd_dosen: "",
        nama_dosen: "",
        foto_dosen: "",
      },
    };
  },
  created() {
    this.loadDataUser();
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
    async addDataDosen() {
      // menampilkan loading
      this.isLoadingData = true;
      // console.log(this.dosen)

      // fetch data dari api menggunakan axios
      axios
        .post("http://127.0.0.1:8000/api/dosen", this.dosen, this.id_user)
        .then((response) => {
          // mengirim data hasil fetch ke varibale array matakuliah
          console.log(response.data.message);
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },
    // watch: {
    //   multiple (val) {
    //     if (val) this.model = [this.model]
    //     else this.model = this.model[0]
    //   },
    // },
  },
};
</script>