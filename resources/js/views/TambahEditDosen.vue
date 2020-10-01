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
            ref="nama-lengkap"
            v-model="nama_dosen"
            :rules="[() => !!nama_dosen || 'This field is required']"
            :error-messages="errorMessages"
            label="Nama Lengkap"
            required
          ></v-text-field>
          <v-text-field
            ref="kd-dosen"
            v-model="kd_dosen"
            :rules="[
              () => !!kd_dosen || 'This field is required',
            ]"
            :error-messages="errorMessages"
            label="Kode Dosen"
            required
          ></v-text-field>
          <br>
          <v-select
            ref="id-user"
            v-model="id_user"
            :rules="[() => !!id_user || 'This field is required']"
            :items="form.id_user"
            label="ID User"
            item-text="id"
            item-value="id"
            placeholder="Select..."
            required
          ></v-select>
          <v-text-field
            ref="foto-dosen"
            v-model="foto_dosen"
            :rules="[() => !!foto_dosen || 'This field is required']"
            :error-messages="errorMessages"
            label="Foto Dosen"
            required
          ></v-text-field>
        </v-card-text>
        <v-divider class="mt-12"></v-divider>
        <v-card-actions>
          <v-btn text to=/dosen>
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
            @click="addDataDosen"
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
              kd_dosen: '',
              nama_dosen: '',
              foto_dosen: '',
              id_user: ''
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
                .then(response => {
                    // mengirim data hasil fetch ke varibale array surat izin
                    this.form.id_user = response.data.data.user;
                })
                .catch(e => {
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

            // fetch data dari api menggunakan axios
            axios
                .post("http://127.0.0.1:8000/api/dosen", this.form)
                .then(response => {
                    // mengirim data hasil fetch ke varibale array matakuliah
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
        // watch: {
        //   multiple (val) {
        //     if (val) this.model = [this.model]
        //     else this.model = this.model[0]
        //   },
        // },
    }
};
</script>