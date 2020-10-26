<template>
  <DosenForm
    :dosen="dosen"
    :id_user="id_user"
    :onSubmit="updateDataDosen"
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

  mounted() {
    const { kd_dosen } = this.$route.params;
    console.log(kd_dosen);
    this.load(kd_dosen);
  },

  methods: {
    load(id) {
      axios
        .get("http://127.0.0.1:8000/api/dosen/" + id)
        .then((dosen) => {
          console.log(dosen.data.data.dosen)
          this.dosen = dosen.data.data.dosen;
          //this.dosen = response.data.data.dosen
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

    async updateDataDosen() {
      // menampilkan loading
      this.isLoadingData = true;
      // console.log(this.dosen)

      // fetch data dari api menggunakan axios
      axios
        .put(
          "http://127.0.0.1:8000/api/dosen/" + this.dosen.kd_dosen,
          this.dosen,
          this.id_user,
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