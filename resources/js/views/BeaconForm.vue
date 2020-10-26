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
            ref="kode-beacon"
            v-model="beacon.kd_beacon"
            :rules="[() => !!beacon.kd_beacon || 'This field is required']"
            label="Kode Beacon"
            required
          ></v-text-field>
          <v-text-field
            ref="mac-address-beacon"
            v-model="beacon.mac_address"
            :rules="[() => !!beacon.mac_address || 'This field is required']"
            label="Mac Address Beacon"
            required
          ></v-text-field>
          <v-text-field
            ref="major-beacon"
            v-model="beacon.major"
            :rules="[() => !!beacon.major || 'This field is required']"
            label="Major"
            required
          ></v-text-field>
          <v-text-field
            ref="minor-beacon"
            v-model="beacon.minor"
            :rules="[() => !!beacon.minor || 'This field is required']"
            label="Minor"
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
  props: ["beacon", "onSubmit"],
  methods: {
    async submit() {
      this.onSubmit();
    },
  },
};
</script>