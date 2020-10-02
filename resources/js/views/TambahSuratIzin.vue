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
            ref="kode-jenis-izin"
            v-model="form.kd_jenis_izin"
            :rules="[() => !!form.kd_jenis_izin || 'This field is required']"
            label="Kode Jenis Izin"
            placeholder="Ketik I, S, atau D"
            required
          ></v-text-field>
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
            v-model="form.nim"
            :rules="[() => !!form.nim || 'This field is required']"
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
            v-model="form.tgl_mulai"
            :rules="[() => !!form.tgl_mulai || 'This field is required']"
            label="Tanggal Mulai"
            placeholder="2020-1-1"
            required
          ></v-text-field>

          <v-text-field
            ref="tgl-selesai"
            v-model="form.tgl_selesai"
            :rules="[() => !!form.tgl_selesai || 'This field is required']"
            label="Tanggal Selesai"
            placeholder="2020-1-1"
            required
          ></v-text-field>
        <!-- <v-menu
            ref="menu"
            v-model="menu"
            :close-on-content-click="false"
            :return-value.sync="form.tgl_mulai"
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
                v-model="form.tgl_mulai"
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
            :return-value.sync="form.tgl_selesai"
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
                v-model="form.tgl_selesai"
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

          <v-text-field
            ref="status-surat"
            v-model="form.kd_status_surat"
            label="Status Surat"
          ></v-text-field>

          <!-- <v-text-field
            ref="catatan-surat"
            v-model="form.catatan_surat"
            label="Catatan Surat"
          ></v-text-field>

          <v-text-field
            ref="catatan-wali-dosen"
            v-model="form.catatan_wali_dosen"
            label="Catatan Wali Dosen" -->
          <!-- ></v-text-field> -->

          <!-- JAM MULAI -->

            <!-- <v-text-field
            ref="jam-mulai"
            v-model="form.jam_mulai"
            :rules="[() => !!form.jam_mulai || 'This field is required']"
            label="Jam Mulai"
            placeholder="00:00:00"
            required
          ></v-text-field>

          <v-text-field
            ref="jam-selesai"
            v-model="form.jam_selesai"
            :rules="[() => !!form.jam_selesai || 'This field is required']"
            label="Jam Selesai"
            placeholder="00:00:00"
            required
          ></v-text-field> -->

            <!-- <v-menu
                ref="menu3"
                v-model="menu3"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="form.jam_mulai"
                transition="scale-transition"
                offset-y
                max-width="350px"
                min-width="350px"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="form.jam_mulai"
                        label="Jam Mulai"
                        prepend-icon="mdi-clock-time-four-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-time-picker
                    v-if="menu3"
                    v-model="form.jam_mulai"
                    use-seconds
                    full-width
                    @click:second="$refs.menu3.save(form.jam_mulai)"
                ></v-time-picker>
            </v-menu>
        <v-spacer></v-spacer> -->

          <!-- JAM SELESAI -->

            <!-- <v-menu
                ref="menu4"
                v-model="menu4"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="form.jam_selesai"
                transition="scale-transition"
                offset-y
                max-width="350px"
                min-width="350px"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="form.jam_selesai"
                        label="Jam Selesai"
                        prepend-icon="mdi-clock-time-four-outline"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-time-picker
                    v-if="menu4"
                    v-model="form.jam_selesai"
                    use-seconds
                    full-width
                    @click:second="$refs.menu4.save(form.jam_selesai)"
                ></v-time-picker>
            </v-menu>
        <v-spacer></v-spacer> -->

          <v-text-field
            ref="foto-surat"
            v-model="form.foto_surat"
            :rules="[() => !!form.foto_surat || 'This field is required']"
            label="Foto Surat"
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
            @click="addDataSurat"
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
  data() {
    return {
      menu: false,
      menu2: false,
      menu3: false,
      menu4: false,
      nim: [],
      form: {
        kd_jenis_izin: "",
        // nim: "",
        tgl_mulai: "", //format(parseISO(new Date().toISOString()),'yyyy-M-d'),
        tgl_selesai: "", //format(parseISO(new Date().toISOString()),'yyyy-M-d'),
        kd_status_surat: "",
        //   catatan_surat: '',
        //   catatan_wali_dosen: '',
        //   jam_mulai: '',
        //   jam_selesai: '',
        foto_surat: "",
      },
    };
  },
  created() {
      this.loadDataMahasiswa();
  },
  computed: {
    computedDateFormattedMomentjs() {
      return this.form.tgl_mulai
        ? moment(this.form.tgl_mulai).format("YYYY-M-D")
        : "";
    },
    computedDateFormattedMomentjs2() {
      return this.form.tgl_selesai
        ? moment(this.form.tgl_selesai).format("YYYY-M-D")
        : "";
    },
  },
  methods: {
    async loadDataMahasiswa() {
        // menampilkan loading
        this.isLoadingData = true;

        // fetch data dari api menggunakan axios
        axios
            .get("http://127.0.0.1:8000/api/mahasiswa")
            .then(response => {
                // mengirim data hasil fetch ke varibale array surat izin
                this.nim = response.data.data.mahasiswa;
            })
            .catch(e => {
                console.log(e);
            })
            .finally(() => {
                // mengakhiri loading
                this.isLoadingData = false;
            });
    },
    async addDataSurat() {
      // menampilkan loading
      this.isLoadingData = true;
      // console.log(this.form)

      // fetch data dari api menggunakan axios
      axios
        .post("http://127.0.0.1:8000/api/surat-izin", this.form /*this.nim*/)
        .then((response) => {
          // mengirim data hasil fetch ke varibale array surat
          console.log("response" + JSON.stringify(response.data));
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },
  },
};
</script>