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
            ref="email-user"
            v-model="form.email"
            :rules="[() => !!form.email || 'This field is required']"
            :error-messages="errorMessages"
            label="Email User"
            required
          ></v-text-field>
          <v-text-field
            ref="password-user"
            v-model="form.password"
            :rules="[() => !!form.password || 'This field is required']"
            :error-messages="errorMessages"
            label="Password User"
            required
          ></v-text-field>
        </v-card-text>
        <v-divider class="mt-12"></v-divider>
        <v-card-actions>
          <v-btn text to=/user>
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
            @click="addDataUser"
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
              email: '',
              password: ''
            }
        };
    },
    // created() {
    //     this.loadDataMatkul();
    //     document.title = "Matakuliah | BePresensi";
    // },
    methods: {
        async addDataUser() {
            // menampilkan loading
            this.isLoadingData = true;

            // fetch data dari api menggunakan axios
            axios
                .post("http://127.0.0.1:8000/api/user", this.form)
                .then(response => {
                    // mengirim data hasil fetch ke varibale array user
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