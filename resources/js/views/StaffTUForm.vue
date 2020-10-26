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
            v-model="staffTU.kd_staff"
            :rules="[() => !!staffTU.kd_staff || 'This field is required']"
            label="Kode Staff"
            required
          ></v-text-field>
          <v-text-field
            ref="nama-staff"
            v-model="staffTU.nama_staff"
            :rules="[() => !!staffTU.nama_staff || 'This field is required']"
            label="Nama Lengkap"
            required
          ></v-text-field>
          <br>
          <v-select
            ref="id-user"
            v-model="staffTU.id_user"
            :rules="[() => !!staffTU.id_user || 'This field is required']"
            :items="id_user"
            label="ID User"
            item-text="email"
            item-value="id"
            placeholder="Select..."
            required
          ></v-select>
          <v-text-field
            ref="foto-staff"
            v-model="staffTU.foto_staff"
            :rules="[() => !!staffTU.foto_staff || 'This field is required']"
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
  props: ["staffTU", "onSubmit", "id_user"],
  methods: {
    async submit() {
      this.onSubmit();
    },
  },
};
</script>