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
            v-model="matakuliah.nama_matakuliah"
            :rules="[() => !!matakuliah.nama_matakuliah || 'This field is required']"
            label="Nama Mata Kuliah"
            required
          ></v-text-field>
          <v-text-field
            ref="id-matkul"
            v-model="matakuliah.kd_matakuliah"
            :rules="[() => !!matakuliah.kd_matakuliah || 'This field is required']"
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
            @click="submit"
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
  props: ["matakuliah", "onSubmit"],

  // created() {
  //     this.loadDataMatkul();
  //     document.title = "Matakuliah | BePresensi";
  // },
  methods: {
    async submit() {
      this.onSubmit();
    },
  },
};
</script>