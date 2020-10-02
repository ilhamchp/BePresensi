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
            ref="nama-dosen"
            v-model="form.nama_dosen"
            :rules="[() => !!form.nama_dosen || 'This field is required']"
            label="Nama Lengkap"
            required
          ></v-text-field>
          <v-text-field
            ref="kd-dosen"
            v-model="form.kd_dosen"
            :rules="[() => !!form.kd_dosen || 'This field is required']"
            label="Kode Dosen"
            required
          ></v-text-field>
          <br>
          <v-select
            ref="id-user"
            v-model="form.id_user"
            :rules="[() => !!form.id_user || 'This field is required']"
            :items="id_user"
            label="ID User"
            item-text="email"
            item-value="id"
            placeholder="Select..."
            required
          ></v-select>
          <v-text-field
            ref="foto-dosen"
            v-model="form.foto_dosen"
            :rules="[() => !!form.foto_dosen || 'This field is required']"
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
          id_user: [],
            form: {
              kd_dosen: '',
              nama_dosen: '',
              foto_dosen: '',
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
                    this.id_user = response.data.data.user;
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
            // console.log(this.form)

            // fetch data dari api menggunakan axios
            axios
                .post("http://127.0.0.1:8000/api/dosen", this.form, this.id_user)
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