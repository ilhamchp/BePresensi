<template>
  <SesiForm
    :sesi="sesi"
    :onSubmit="addDataSesi"
  ></SesiForm>
</template>

<script>
import SesiForm from './SesiForm';

export default {
  components: {
    SesiForm
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
  
  methods: {
    async addDataSesi() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .post("http://127.0.0.1:8000/api/sesi", this.sesi)
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
  },
};
</script>