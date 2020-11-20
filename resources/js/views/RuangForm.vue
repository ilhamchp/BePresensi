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
            ref="kode-ruang"
            v-model="ruang.kd_ruang"
            :rules="[() => !!ruang.kd_ruang || 'This field is required']"
            label="Kode Ruang"
            required
          ></v-text-field>
          <v-text-field
            ref="nama-ruang"
            v-model="ruang.nama_ruang"
            :rules="[() => !!ruang.nama_ruang || 'This field is required']"
            label="Nama Ruang"
            required
          ></v-text-field>
          <v-select
            ref="kode-beacon"
            v-model="ruang.kd_beacon"
            :rules="[() => !!ruang.kd_beacon || 'This field is required']"
            :items="kd_beacon"
            label="Kode Beacon"
            item-text="kd_beacon"
            item-value="kd_beacon"  
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
  props: ["ruang", "onSubmit", "kd_beacon"],
  methods: {
    async submit() {
      this.onSubmit();
    },
  },
};
</script>