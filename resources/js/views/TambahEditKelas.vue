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
            ref="kode-kelas"
            v-model="form.kd_kelas"
            :rules="[() => !!form.kd_kelas || 'This field is required']"
            :error-messages="errorMessages"
            label="Kode Kelas"
            required
          ></v-text-field>
          <v-text-field
            ref="tingkat-kelas"
            v-model="form.tingkat_kelas"
            :rules="[() => !!form.tingkat_kelas || 'This field is required']"
            :error-messages="errorMessages"
            label="Tingkat Kelas"
            required
          ></v-text-field>
          <v-text-field
            ref="prodi"
            v-model="form.prodi"
            :rules="[() => !!form.prodi || 'This field is required']"
            :error-messages="errorMessages"
            label="Program Studi"
            required
          ></v-text-field>
          <v-text-field
            ref="angkatan"
            v-model="form.angkatan"
            :rules="[() => !!form.angkatan || 'This field is required']"
            :error-messages="errorMessages"
            label="Angkatan"
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
            @click="addDataKelas"
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
              kd_kelas: '',
              tingkat_kelas: '',
              prodi: '',
              angkatan: ''
            }
        };
    },
    // created() {
    //     this.loadDataMatkul();
    //     document.title = "Matakuliah | BePresensi";
    // },
    methods: {
        async addDataKelas() {
            // menampilkan loading
            this.isLoadingData = true;

            // fetch data dari api menggunakan axios
            axios
                .post("http://127.0.0.1:8000/api/kelas", this.form)
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