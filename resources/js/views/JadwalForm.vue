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
            ref="kd-jadwal"
            v-model="jadwal.kd_jadwal"
            :rules="[() => !!jadwal.kd_jadwal || 'This field is required']"
            label="Kode Jadwal"
            required
          ></v-text-field> -->
          <v-select
            ref="kode-kelas"
            v-model="jadwal.kd_kelas"
            :rules="[() => !!jadwal.kd_kelas || 'This field is required']"
            :items="kd_kelas"
            label="Kelas"
            item-text="kd_kelas"
            item-value="kd_kelas"
            placeholder="Select..."
            required
          ></v-select>
          <br>
          <v-select
            ref="kode-hari"
            v-model="jadwal.kd_hari"
            :rules="[() => !!jadwal.kd_hari || 'This field is required']"
            :items="kd_hari"
            label="Hari"
            item-text="nama_hari"
            item-value="kd_hari"
            placeholder="Select..."
            required
          ></v-select>
          <v-select
            ref="kode-sesi-mulai"
            v-model="jadwal.kd_sesi_mulai"
            :rules="[() => !!jadwal.kd_sesi_mulai || 'This field is required']"
            :items="kd_sesi"
            label="Sesi Mulai"
            item-text="kd_sesi"
            item-value="kd_sesi"
            placeholder="Select..."
            required
          ></v-select>
          <v-select
            ref="kode-sesi-berakhir"
            v-model="jadwal.kd_sesi_berakhir"
            :rules="[() => !!jadwal.kd_sesi_berakhir || 'This field is required']"
            :items="kd_sesi"
            label="Sesi Berakhir"
            item-text="kd_sesi"
            item-value="kd_sesi"
            placeholder="Select..."
            required
          ></v-select>
          <v-select
            ref="kode-ruang"
            v-model="jadwal.kd_ruang"
            :rules="[() => !!jadwal.kd_ruang || 'This field is required']"
            :items="kd_ruang"
            label="Ruang"
            item-text="kd_ruang"
            item-value="kd_ruang"
            placeholder="Select..."
            required
          ></v-select>
          <v-select
            ref="kode-matakuliah"
            v-model="jadwal.kd_matakuliah"
            :rules="[() => !!jadwal.kd_matakuliah || 'This field is required']"
            :items="kd_matakuliah"
            label="Mata Kuliah"
            item-text="nama_matakuliah"
            item-value="kd_matakuliah"
            placeholder="Select..."
            required
          ></v-select>
          <v-select
            ref="kode-dosen-pengajar"
            v-model="jadwal.kd_dosen_pengajar"
            :rules="[() => !!jadwal.kd_dosen_pengajar || 'This field is required']"
            :items="kd_dosen"
            label="Dosen"
            item-text="nama_dosen"
            item-value="kd_dosen"
            placeholder="Select..."
            required
          ></v-select>
          <v-select
            ref="jenis-perkuliahan"
            v-model="jadwal.jenis_perkuliahan"
            :rules="[() => !!jadwal.jenis_perkuliahan || 'This field is required']"
            :items="jenis_perkuliahan"
            label="Jenis Perkuliahan"
            item-text="jenis_perkuliahan"
            item-value="jenis_perkuliahan"
            placeholder="Select..."
            required
          ></v-select>
          <!-- <v-text-field
            ref="sesi-presensi-dibuka"
            v-model="jadwal.sesi_presensi_dibuka"
            value="0"
            readonly
          ></v-text-field> -->
          <v-text-field
            ref="toleransi-keterlambatan"
            v-model="jadwal.toleransi_keterlambatan"
            label="Toleransi Keterlambatan"
          ></v-text-field>
          <!-- <v-text-field
            ref="jam-presensi-dibuka"
            v-model="jadwal.jam_presensi_dibuka"
            label="Jam Presensi Dibuka"
          ></v-text-field>
          <v-text-field
            ref="jam-presensi-ditutup"
            v-model="jadwal.jam_presensi_ditutup"
            label="Jam Presensi Ditutup"
          ></v-text-field> -->
        </v-card-text>
        <v-divider class="mt-12"></v-divider>
        <v-card-actions>
          <v-btn text to=/jadwal-matakuliah>
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
  props: ["jadwal", "onSubmit", "kd_kelas", "kd_hari", "kd_sesi", "kd_ruang", "kd_matakuliah", "kd_dosen", "jenis_perkuliahan"],
  methods: {
    async submit() {
      this.onSubmit();
    },
  },
};
</script>