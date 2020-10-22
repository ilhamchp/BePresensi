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
            ref="nim"
            v-model="mahasiswa.nim"
            :rules="[() => !!mahasiswa.nim || 'This field is required']"
            label="NIM"
            required
          ></v-text-field>
          <v-text-field
            ref="nama-mahasiswa"
            v-model="mahasiswa.nama_mahasiswa"
            :rules="[() => !!mahasiswa.nama_mahasiswa || 'This field is required']"
            label="Nama Lengkap"
            required
          ></v-text-field>
          <br>
          <v-select
            ref="id-user"
            v-model="mahasiswa.id_user"
            :rules="[() => !!mahasiswa.id_user || 'This field is required']"
            :items="id_user"
            label="ID User"
            item-text="email"
            item-value="id"
            placeholder="Select..."
            required
          ></v-select>
          <v-text-field
            ref="foto-mahasiswa"
            v-model="mahasiswa.foto_mahasiswa"
            :rules="[() => !!mahasiswa.foto_mahasiswa || 'This field is required']"
            label="Foto Mahasiswa"
            required
          ></v-text-field>
          <v-select
            ref="kd-kelas"
            v-model="mahasiswa.kd_kelas"
            :rules="[() => !!mahasiswa.kd_kelas || 'This field is required']"
            :items="kd_kelas"
            label="Kode Kelas"
            item-text="kd_kelas"
            item-value="kd_kelas"
            placeholder="Select..."
            required
          ></v-select>
        </v-card-text>
        <v-divider class="mt-12"></v-divider>
        <v-card-actions>
          <v-btn text to=/mahasiswa>
            Cancel
          </v-btn>
          <v-spacer></v-spacer>
          <v-slide-x-reverse-transition>
          </v-slide-x-reverse-transition>
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
  props: ["mahasiswa", "onSubmit", "id_user", "kd_kelas"],
  methods: {
    async submit() {
      this.onSubmit();
    },
  },
};
</script>