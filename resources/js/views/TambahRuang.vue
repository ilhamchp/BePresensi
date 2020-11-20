<template>
  <RuangForm
    :ruang="ruang"
    :kd_beacon="kd_beacon"
    :onSubmit="addDataRuang"
  ></RuangForm>
</template>

<script>
import RuangForm from './RuangForm';

export default {
  components: {
    RuangForm
  },

  data() {
    return {
      kd_beacon: [],
      ruang: {
        kd_ruang: '',
        nama_ruang: '',
      },
    };
  },

  created() {
    this.loadDataBeacon();
  },

  methods: {
    async addDataRuang() {
      // menampilkan loading
      this.isLoadingData = true;
      console.log(this.ruang)
      // fetch data dari api menggunakan axios
      axios
        .post("http://127.0.0.1:8000/api/ruang", this.ruang, this.kd_beacon)
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

    async loadDataBeacon() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/beacon")
        .then((response) => {
          this.kd_beacon = response.data.data.beacon;
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