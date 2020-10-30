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
            v-model="kelas.kd_kelas"
            :rules="[() => !!kelas.kd_kelas || 'This field is required']"
            label="Kode Kelas"
            required
          ></v-text-field>
          <v-text-field
            ref="tingkat-kelas"
            v-model="kelas.tingkat_kelas"
            :rules="[() => !!kelas.tingkat_kelas || 'This field is required']"
            label="Tingkat Kelas"
            required
          ></v-text-field>
          <v-text-field
            ref="prodi"
            v-model="kelas.prodi"
            :rules="[() => !!kelas.prodi || 'This field is required']"
            label="Program Studi"
            required
          ></v-text-field>
          <v-text-field
            ref="angkatan"
            v-model="kelas.angkatan"
            :rules="[() => !!kelas.angkatan || 'This field is required']"
            label="Angkatan"
            required
          ></v-text-field>
          <!-- <v-text-field
            ref="kode-wali-dosen"
            v-model="kelas.kd_wali_dosen"
            :rules="[() => !!kelas.kd_wali_dosen || 'This field is required']"
            label="Kode Wali Dosen"
            required
          ></v-text-field> -->

          <v-select
            ref="kode-wali-dosen"
            v-model="kelas.kd_wali_dosen"
            :rules="[() => !!kelas.kd_wali_dosen || 'This field is required']"
            :items="kd_dosen"
            label="Wali Dosen"
            item-text="nama_dosen"
            item-value="kd_dosen"  
            placeholder="Select..."
            required
          ></v-select>

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
  props: ["kelas", "onSubmit", "kd_dosen"],
  methods: {
    async submit() {
      this.onSubmit();
    },
  },
};
</script>