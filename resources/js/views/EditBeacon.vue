<template>
  <BeaconForm :beacon="beacon" :onSubmit="updateDataBeacon"></BeaconForm>
</template>

<script>
import BeaconForm from "./BeaconForm";

export default {
  components: {
    BeaconForm,
  },

  data() {
    return {
      beacon: {
        kd_beacon: "",
        mac_address: "",
        major: "",
        minor: "",
      },
    };
  },

  mounted() {
    const { kd_beacon } = this.$route.params;
    console.log(kd_beacon);
    this.load(kd_beacon);
  },

  methods: {
    load(id) {
      axios.get("http://127.0.0.1:8000/api/beacon/" + id)
      .then((beacon) => {
        console.log(beacon.data.data.beacon);
        this.beacon = beacon.data.data.beacon;
      });
    },

    async updateDataBeacon() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .put(
          "http://127.0.0.1:8000/api/beacon/" + this.beacon.kd_beacon,
          this.beacon
        )
        .then((response) => {
          // mengirim data hasil fetch ke varibale array beacon
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