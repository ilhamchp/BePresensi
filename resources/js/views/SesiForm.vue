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
            ref="kode-sesi"
            v-model="sesi.kd_sesi"
            :rules="[() => !!sesi.kd_sesi || 'This field is required']"
            label="Kode Sesi"
            required
          ></v-text-field>
          <v-text-field
            ref="jam-mulai"
            v-model="sesi.jam_mulai"
            :rules="[() => !!sesi.jam_mulai || 'This field is required']"
            label="Jam Mulai"
            required
          ></v-text-field>
          <v-text-field
            ref="jam-berakhir"
            v-model="sesi.jam_berakhir"
            :rules="[() => !!sesi.jam_berakhir || 'This field is required']"
            label="Jam Berakhir"
            required
          ></v-text-field>
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
  props: ["sesi", "onSubmit"],
  methods: {
    async submit() {
      this.onSubmit();
    },
  },
};
</script>