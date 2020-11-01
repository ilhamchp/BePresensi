<template>
  <SesiForm :sesi="sesi" :onSubmit="updateDataSesi"></SesiForm>
</template>

<script>
import SesiForm from "./SesiForm";

export default {
  components: {
    SesiForm,
  },

  data() {
    return {
      sesi: {
        kd_sesi: "",
        jam_mulai: "",
        jam_berakhir: "",
      },
    };
  },

  mounted() {
    const { kd_sesi } = this.$route.params;
    console.log(kd_sesi);
    this.load(kd_sesi);
  },

  methods: {
    load(id) {
      axios
        .get("http://127.0.0.1:8000/api/sesi/" + id)
        .then((sesi) => {
          this.sesi = sesi.data.data.sesi;
        });
    },

    async updateDataSesi() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .put("http://127.0.0.1:8000/api/sesi/" + this.sesi.kd_sesi, this.sesi)
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