<template>
  <RuangForm
    :ruang="ruang"
    :kd_beacon="kd_beacon"
    :onSubmit="updateDataRuang"
  ></RuangForm>
</template>

<script>
import RuangForm from "./RuangForm";

export default {
  components: {
    RuangForm,
  },

  data() {
    return {
      kd_beacon: [],
      ruang: {
        kd_ruang: "",
        nama_ruang: "",
      },
    };
  },

  created() {
    this.loadDataBeacon();
  },

  mounted() {
    const { kd_ruang } = this.$route.params;
    console.log(kd_ruang);
    this.load(kd_ruang);
  },
  methods: {
    load(id) {
      axios.get("http://127.0.0.1:8000/api/ruang/" + id).then((ruang) => {
        this.ruang = ruang.data.data.ruang;
      });
    },

    async updateDataRuang() {
      // menampilkan loading
      this.isLoadingData = true;
      console.log(this.ruang);
      // fetch data dari api menggunakan axios
      axios
        .put(
          "http://127.0.0.1:8000/api/ruang/" + this.ruang.kd_ruang,
          this.ruang,
          this.kd_beacon
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