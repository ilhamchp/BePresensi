<template>
  <BeaconForm
    :beacon="beacon"
    :onSubmit="addDataBeacon"
  ></BeaconForm>
</template>

<script>
import BeaconForm from './BeaconForm';

export default {
  components: {
    BeaconForm
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
  
  methods: {
    async addDataBeacon() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .post("http://127.0.0.1:8000/api/beacon", this.beacon)
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