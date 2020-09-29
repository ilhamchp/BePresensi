<template>
  <v-row justify="center">
    <v-col
      cols="12"
      sm="10"
      md="8"
      lg="6"
    >
      <v-card ref="form">
        <v-card-text>
          <v-text-field
            ref="kode-beacon"
            v-model="form.kd_beacon"
            :rules="[() => !!form.kd_beacon || 'This field is required']"
            :error-messages="errorMessages"
            label="Kode Beacon"
            required
          ></v-text-field>
          <v-text-field
            ref="mac-address-beacon"
            v-model="form.mac_address"
            :rules="[() => !!form.mac_address || 'This field is required']"
            :error-messages="errorMessages"
            label="Mac Address Beacon"
            required
          ></v-text-field>
          <v-text-field
            ref="major-beacon"
            v-model="form.major"
            :rules="[() => !!form.major || 'This field is required']"
            :error-messages="errorMessages"
            label="Major"
            required
          ></v-text-field>
          <v-text-field
            ref="minor-beacon"
            v-model="form.minor"
            :rules="[() => !!form.minor || 'This field is required']"
            :error-messages="errorMessages"
            label="Minor"
            required
          ></v-text-field>
        </v-card-text>
        <v-divider class="mt-12"></v-divider>
        <v-card-actions>
          <v-btn text to=/beacon>
            Cancel
          </v-btn>
          <v-spacer></v-spacer>
          <v-slide-x-reverse-transition>
            <v-tooltip
              v-if="formHasErrors"
              left
            >
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  icon
                  class="my-0"
                  v-bind="attrs"
                  @click="resetForm"
                  v-on="on"
                >
                  <v-icon>mdi-refresh</v-icon>
                </v-btn>
              </template>
              <span>Refresh form</span>
            </v-tooltip>
          </v-slide-x-reverse-transition>
          <v-btn
            color="primary"
            text
            @click="addDataBeacon"
          >
            Submit
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
    data() {
        return {
            form: {
              kd_beacon: '',
              mac_address: '',
              major: '',
              minor: ''
            }
        };
    },
    // created() {
    //     this.loadDataMatkul();
    //     document.title = "Matakuliah | BePresensi";
    // },
    methods: {
        async addDataBeacon() {
            // menampilkan loading
            this.isLoadingData = true;

            // fetch data dari api menggunakan axios
            axios
                .post("http://127.0.0.1:8000/api/beacon", this.form)
                .then(response => {
                    // mengirim data hasil fetch ke varibale array beacon
                    this.load()
                })
                .catch(e => {
                    console.log(e);
                })
                .finally(() => {
                    // mengakhiri loading
                    this.isLoadingData = false;
                });
        }
    }
};
</script>