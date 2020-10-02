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
            ref="kd-staff"
            v-model="form.kd_staff"
            :rules="[() => !!form.kd_staff || 'This field is required']"
            label="Kode Staff"
            required
          ></v-text-field>
          <v-text-field
            ref="nama-staff"
            v-model="form.nama_staff"
            :rules="[() => !!form.nama_staff || 'This field is required']"
            label="Nama Lengkap"
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
            ref="foto-staff"
            v-model="form.foto_staff"
            :rules="[() => !!form.foto_staff || 'This field is required']"
            label="Foto Staff"
            required
          ></v-text-field>
        </v-card-text>
        <v-divider class="mt-12"></v-divider>
        <v-card-actions>
          <v-btn text to=/staff-tu>
            Cancel
          </v-btn>
          <v-spacer></v-spacer>
          <v-slide-x-reverse-transition>
          </v-slide-x-reverse-transition>
          <v-btn
            color="primary"
            text
            @click="addDataStaff"
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
              kd_staff: '',
              nama_staff: '',
              foto_staff: '',
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
        async addDataStaff() {
            // menampilkan loading
            this.isLoadingData = true;
            // console.log(this.form)

            // fetch data dari api menggunakan axios
            axios
                .post("http://127.0.0.1:8000/api/staff-tu", this.form, this.id_user)
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
    }
};
</script>