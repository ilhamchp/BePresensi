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
            ref="nama-matkul"
            v-model="form.nama_matakuliah"
            :rules="[() => !!form.nama_matakuliah || 'This field is required']"
            label="Nama Mata Kuliah"
            required
          ></v-text-field>
          <v-text-field
            ref="id-matkul"
            v-model="form.kd_matakuliah"
            :rules="[() => !!form.kd_matakuliah || 'This field is required']"
            label="Kode Mata Kuliah"
            required
          ></v-text-field>
        </v-card-text>
        <v-divider class="mt-12"></v-divider>
        <v-card-actions>
          <v-btn text to=/matakuliah>
            Cancel
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="addDataMatkul"
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
        nama_matakuliah: "",
        kd_matakuliah: "",
      },
    };
  },
  // created() {
  //     this.loadDataMatkul();
  //     document.title = "Matakuliah | BePresensi";
  // },
  methods: {
    async addDataMatkul() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .post("http://127.0.0.1:8000/api/matakuliah", this.form)
        .then((response) => {
          // mengirim data hasil fetch ke varibale array matakuliah
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