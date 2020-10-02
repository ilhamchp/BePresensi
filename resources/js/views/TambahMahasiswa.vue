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
            v-model="form.nim"
            :rules="[() => !!form.nim || 'This field is required']"
            label="NIM"
            required
          ></v-text-field>
          <v-text-field
            ref="nama-mahasiswa"
            v-model="form.nama_mahasiswa"
            :rules="[() => !!form.nama_mahasiswa || 'This field is required']"
            label="Nama Lengkap"
            required
          ></v-text-field>
          <br>
          <v-select
            ref="id-user"
            v-model="form.id_user"
            :rules="[() => !!form.id_user || 'This field is required']"
            :items="id_user"
            label="ID User"
            item-text="email"
            item-value="id"
            placeholder="Select..."
            required
          ></v-select>
          <v-text-field
            ref="foto-mahasiswa"
            v-model="form.foto_mahasiswa"
            :rules="[() => !!form.foto_mahasiswa || 'This field is required']"
            label="Foto Mahasiswa"
            required
          ></v-text-field>
          <v-select
            ref="kd-kelas"
            v-model="form.kd_kelas"
            :rules="[() => !!form.kd_kelas || 'This field is required']"
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
            @click="addDataMahasiswa"
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
  data() {
    return {
      id_user: [],
      kd_kelas: [],
      form: {
        nim: "",
        nama_mahasiswa: "",
        foto_mahasiswa: "",
      },
    };
  },
  created() {
    this.loadDataUser();
    this.loadDataKelas();
  },
  methods: {
    async loadDataUser() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/dropdown-user")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array surat izin
          this.id_user = response.data.data.user;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },
    async loadDataKelas() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/kelas")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array surat izin
          this.kd_kelas = response.data.data.kelas;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },
    async addDataMahasiswa() {
      // menampilkan loading
      this.isLoadingData = true;
      // console.log(this.form)

      // fetch data dari api menggunakan axios
      axios
        .post(
          "http://127.0.0.1:8000/api/mahasiswa",
          this.form,
          this.id_user,
          this.kd_kelas
        )
        .then((response) => {
          // mengirim data hasil fetch ke varibale array matakuliah
          this.load();
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