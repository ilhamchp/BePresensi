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
            ref="nama-lengkap"
            v-model="nama"
            :rules="[() => !!nama || 'This field is required']"
            :error-messages="errorMessages"
            label="Nama Lengkap"
            required
          ></v-text-field>
          <v-text-field
            ref="NIP"
            v-model="nip"
            :rules="[
              () => !!nip || 'This field is required',
              () => !!nip && nip.length <= 18 || 'NIP must be less than 18 characters',
              nimCheck
            ]"
            label="NIP"
            counter="18"
            required
          ></v-text-field>
          <br>
          <v-select
            ref="id-user"
            v-model="iduser"
            :rules="[() => !!iduser || 'This field is required']"
            :items="items"
            label="ID User"
            placeholder="Select..."
            required
          ></v-select>
        </v-card-text>
        <v-divider class="mt-12"></v-divider>
        <v-card-actions>
          <v-btn text to=/dosen>
            Cancel
          </v-btn>
          <v-spacer></v-spacer>
          <v-slide-x-reverse-transition>
            <v-tooltip
              v-if="formHasErrors"
              left
            >
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  icon
                  class="my-0"
                  v-bind="attrs"
                  @click="resetForm"
                  v-on="on"
                >
                  <v-icon>mdi-refresh</v-icon>
                </v-btn>
              </template>
              <span>Refresh form</span>
            </v-tooltip>
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
    data: () => ({
      items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
      disabled: false,
      readonly: false,
      chips: false,
      multiple: false,
      appendIcon: false,
      appendSlot: false,
      appendItemSlot: false,
      prependIcon: false,
      prependSlot: false,
      prependItemSlot: false,
      selectSlot: false,
      model: 'Foo',
    }),

    watch: {
      multiple (val) {
        if (val) this.model = [this.model]
        else this.model = this.model[0] || 'Foo'
      },
    },
  }
</script>