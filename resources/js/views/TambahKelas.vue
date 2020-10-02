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
            label="Kode Kelas"
            required
          ></v-text-field>
          <v-text-field
            ref="tingkat-kelas"
            v-model="form.tingkat_kelas"
            :rules="[() => !!form.tingkat_kelas || 'This field is required']"
            label="Tingkat Kelas"
            required
          ></v-text-field>
          <v-text-field
            ref="prodi"
            v-model="form.prodi"
            :rules="[() => !!form.prodi || 'This field is required']"
            label="Program Studi"
            required
          ></v-text-field>
          <v-text-field
            ref="angkatan"
            v-model="form.angkatan"
            :rules="[() => !!form.angkatan || 'This field is required']"
            label="Angkatan"
            required
          ></v-text-field>
          <v-text-field
            ref="kode-wali-dosen"
            v-model="form.kd_wali_dosen"
            :rules="[() => !!form.kd_wali_dosen || 'This field is required']"
            label="Kode Wali Dosen"
            required
          ></v-text-field>

          <!-- <v-select
            ref="kode-wali-dosen"
            v-model="form.kd_wali_dosen"
            :rules="[() => !!form.kd_wali_dosen || 'This field is required']"
            :items="kd_wali_dosen"
            label="Wali Dosen"
            item-text="kd_dosen"
            item-value="kd_wali_dosen"  
            placeholder="Select..."
            required
          ></v-select> -->

        </v-card-text>
        <v-divider class="mt-12"></v-divider>
        <v-card-actions>
          <v-btn text to=/beacon>
            Cancel
          </v-btn>
          <v-spacer></v-spacer>
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
      // kd_wali_dosen: [],
      form: {
        kd_kelas: '',
        tingkat_kelas: '',
        prodi: '',
        angkatan: '',
        kd_wali_dosen: ''
      },
    };
  },

  created() {
    this.loadDataDosen();
  },

  methods: {
    async addDataKelas() {
      // menampilkan loading
      this.isLoadingData = true;
      // console.log(this.form)
      // fetch data dari api menggunakan axios
      axios
        .post("http://127.0.0.1:8000/api/kelas", this.form)
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

    async loadDataDosen() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/dosen")
        .then((response) => {

          // this.kd_wali_dosen = response.data.data.dosen.kd_dosen; //Data dosen tidak dapat dimuat

          // this.kd_wali_dosen = response.data.data.dosen; //Data dosen dapat dimuat, tapi Post error 404
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