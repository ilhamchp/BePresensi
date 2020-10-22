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
            ref="kd-dosen"
            v-model="dosen.kd_dosen"
            :rules="[() => !!dosen.kd_dosen || 'This field is required']"
            label="Kode Dosen"
            required
          ></v-text-field>
          <v-text-field
            ref="nama-dosen"
            v-model="dosen.nama_dosen"
            :rules="[() => !!dosen.nama_dosen || 'This field is required']"
            label="Nama Lengkap"
            required
          ></v-text-field>
          <br>
          <v-select
            ref="id-user"
            v-model="dosen.id_user"
            :rules="[() => !!dosen.id_user || 'This field is required']"
            :items="id_user"
            label="ID User"
            item-text="email"
            item-value="id"
            placeholder="Select..."
            required
          ></v-select>
          <v-text-field
            ref="foto-dosen"
            v-model="dosen.foto_dosen"
            :rules="[() => !!dosen.foto_dosen || 'This field is required']"
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
  props: ["dosen", "onSubmit", "id_user"],
  methods: {
    async submit() {
      this.onSubmit();
    },
  },
};
</script>