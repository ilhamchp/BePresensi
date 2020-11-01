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

          <!-- <v-text-field
            ref="kode-surat-izin"
            v-model="surat_izin.kd_surat_izin"
            :rules="[() => !!surat_izin.kd_surat_izin || 'This field is required']"
            label="Kode Surat Izin"
            placeholder="Kode Surat Izin"
            required
          ></v-text-field> -->

          <v-select
            ref="kode-jenis-izin"
            v-model="surat_izin.kd_jenis_izin"
            :rules="[() => !!surat_izin.kd_jenis_izin || 'This field is required']"
            :items="kd_status_presensi"
            label="Jenis Izin"
            item-text="keterangan_presensi"
            item-value="kd_status_presensi"
            placeholder="Select..."
            required
          ></v-select>
          <br>

          <!-- <v-text-field
            ref="nim"
            v-model="form.nim"
            :rules="[() => !!form.nim || 'This field is required']"
            label="NIM"
            required
          ></v-text-field> -->

          <v-select
            ref="nim"
            v-model="surat_izin.nim"
            :rules="[() => !!surat_izin.nim || 'This field is required']"
            :items="nim"
            label="Mahasiswa"
            item-text="nama_mahasiswa"
            item-value="nim"
            placeholder="Select..."
            required
          ></v-select>

        <!-- // DATEPICKER TANGGAL MULAI -->

        <v-text-field
            ref="tgl-mulai"
            v-model="surat_izin.tgl_mulai"
            :rules="[() => !!surat_izin.tgl_mulai || 'This field is required']"
            label="Tanggal Mulai"
            placeholder="2020-1-1"
            required
          ></v-text-field>

          <v-text-field
            ref="tgl-selesai"
            v-model="surat_izin.tgl_selesai"
            :rules="[() => !!surat_izin.tgl_selesai || 'This field is required']"
            label="Tanggal Selesai"
            placeholder="2020-1-1"
            required
          ></v-text-field>

        <!-- <v-menu
            ref="menu"
            v-model="menu"
            :close-on-content-click="false"
            :return-value.sync="surat_izin.tgl_mulai"
            transition="scale-transition"
            offset-y
            min-width="290px"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-text-field
                    v-model="computedDateFormattedMomentjs"
                    label="Tanggal Mulai"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                ></v-text-field>
            </template>
            <v-date-picker
                v-model="surat_izin.tgl_mulai"
                no-title
                scrollable
            >
                <v-spacer></v-spacer>
                <v-btn
                    text
                    color="primary"
                    @click="menu = false"
                >
                Cancel
                </v-btn>
                <v-btn
                    text
                    color="primary"
                    @click="$refs.menu.save(computedDateFormattedMomentjs)"
                >
                OK
                </v-btn>
        </v-date-picker>
      </v-menu>
    <v-spacer></v-spacer> -->

        <!-- DATEPICKER TANGGAL SELESAI -->
        <!-- <v-menu
            ref="menu2"
            v-model="menu2"
            :close-on-content-click="false"
            :return-value.sync="surat_izin.tgl_selesai"
            transition="scale-transition"
            offset-y
            min-width="290px"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-text-field
                    v-model="computedDateFormattedMomentjs2"
                    label="Tanggal Selesai"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                ></v-text-field>
            </template>
            <v-date-picker
                v-model="surat_izin.tgl_selesai"
                no-title
                scrollable
            >
                <v-spacer></v-spacer>
                <v-btn
                    text
                    color="primary"
                    @click="menu2 = false"
                >
                Cancel
                </v-btn>
                <v-btn
                    text
                    color="primary"
                    @click="$refs.menu2.save(computedDateFormattedMomentjs2)"
                >
                OK
                </v-btn>
        </v-date-picker>
      </v-menu>
    <v-spacer></v-spacer> -->

          <v-select
            ref="kode-status-surat"
            v-model="surat_izin.status_surat"
            :rules="[() => !!surat_izin.status_surat || 'This field is required']"
            :items="status_surat"
            label="Status Surat"
            item-text="keterangan_surat"
            item-value="kd_status_surat"
            placeholder="Select..."
            required
          ></v-select>

          <!-- <v-text-field
            ref="catatan-surat"
            v-model="surat_izin.catatan_surat"
            label="Catatan Surat"
          ></v-text-field>

          <v-text-field
            ref="catatan-wali-dosen"
            v-model="surat_izin.catatan_wali_dosen"
            label="Catatan Wali Dosen"
            ></v-text-field> -->

          <!-- JAM MULAI -->

            <!-- <v-text-field
            ref="jam-mulai"
            v-model="surat_izin.jam_mulai"
            :rules="[() => !!surat_izin.jam_mulai || 'This field is required']"
            label="Jam Mulai"
            placeholder="00:00:00"
            required
          ></v-text-field>

          <v-text-field
            ref="jam-selesai"
            v-model="surat_izin.jam_selesai"
            :rules="[() => !!surat_izin.jam_selesai || 'This field is required']"
            label="Jam Selesai"
            placeholder="00:00:00"
            required
          ></v-text-field> -->

            <!-- <v-menu
                ref="menu3"
                v-model="surat_izin.jam_mulai"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="surat_izin.jam_mulai"
                transition="scale-transition"
                offset-y
                max-width="350px"
                min-width="350px"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="surat_izin.jam_mulai"
                        label="Jam Mulai"
                        prepend-icon="mdi-clock-time-four-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-time-picker
                    v-if="surat_izin.jam_mulai"
                    v-model="surat_izin.jam_mulai"
                    use-seconds
                    full-width
                    @click:second="$refs.surat_izin.jam_mulai.save(surat_izin.jam_mulai)"
                ></v-time-picker>
            </v-menu>
        <v-spacer></v-spacer> -->

          <!-- JAM SELESAI -->

            <!-- <v-menu
                ref="menu4"
                v-model="surat_izin.jam_selesai"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="surat_izin.jam_selesai"
                transition="scale-transition"
                offset-y
                max-width="350px"
                min-width="350px"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="surat_izin.jam_selesai"
                        label="Jam Selesai"
                        prepend-icon="mdi-clock-time-four-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-time-picker
                    v-if="surat_izin.jam_selesai"
                    v-model="surat_izin.jam_selesai"
                    use-seconds
                    full-width
                    @click:second="$refs.surat_izin.jam_selesai.save(surat_izin.jam_selesai)"
                ></v-time-picker>
            </v-menu>
        <v-spacer></v-spacer> -->

          <v-text-field
            ref="foto-surat"
            v-model="surat_izin.foto_surat"
            :rules="[() => !!surat_izin.foto_surat || 'This field is required']"
            label="Foto Surat"
            required
          ></v-text-field>
        </v-card-text>
        <v-divider class="mt-12"></v-divider>
        <v-card-actions>
          <v-btn text to=/surat-izin>
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
import moment from "moment";
import { format, parseISO } from "date-fns";

export default {
  props: [
    "surat_izin",
    "onSubmit",
    "nim",
    "kd_status_presensi",
    "status_surat",
    "computedDateFormattedMomentjs",
    "computedDateFormattedMomentjs2",
  ],
  methods: {
    async submit() {
      this.onSubmit();
    },
  },
};
</script>