<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Jadwal Mata Kuliah</div>
        <br />

        <!-- Button Data Baru -->
        <v-btn color to=/tambah-jadwal>
            <div class="text-overline">Tambah Data Baru</div>
        </v-btn>
        <br />
        <br />
        <!-- Card Data Table -->
        <v-card loading="isLoadingData">
            <!-- Skeleton Loader -->
            <v-skeleton-loader
                class="ma-3"
                :loading="isLoadingData"
                type="table-thead, table-row@6"
            >
                <!-- Card Title -->
                <v-card-title>
                    <!-- Search Bar -->
                    <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                    ></v-text-field>
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                </v-card-title>
                <!-- Data Table -->
                <v-data-table
                    dense
                    :headers="headers"
                    :items="jadwal"
                    :search="search"
                    show-group-by
                    :items-per-page="5">

                    <template v-slot:[`item.actions`]="{ item }">
                        <v-icon small class="mr-2" @click="editJadwal(item.kd_jadwal)">mdi-pencil</v-icon>
                        <v-icon small @click="deleteJadwal(item.kd_jadwal)">mdi-delete</v-icon>
                    </template>

                ></v-data-table>
            </v-skeleton-loader>
        </v-card>
    </div>
</template>

<script>
export default {
  data() {
    return {
      isLoadingData: false,
      search: "",
      jadwal: [],
      headers: [
        {
          text: "Kode Kelas",
          value: "kd_kelas",
          sortable: true,
          groupable: false,
        },
        {
          text: "Kode Ruang",
          value: "kd_ruang",
          sortable: true,
          groupable: false,
        },
        {
          text: "Jenis Perkuliahan",
          value: "jenis_perkuliahan",
          sortable: true,
          groupable: false,
        },
        {
          text: "Kode Matakuliah",
          value: "matakuliah.nama_matakuliah",
          sortable: true,
          groupable: false,
        },
        {
          text: "Dosen Pengajar",
          align: "start",
          sortable: true,
          groupable: false,
          value: "dosen.nama_dosen",
        },
        {
          text: "Actions",
          value: "actions",
          sortable: false,
          groupable: false,
        },
      ],
    };
  },
  created() {
    this.loadDataJadwal();
    document.title = "Jadwal | BePresensi";
  },
  methods: {
    async loadDataJadwal() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/jadwal")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array kelas
          this.jadwal = response.data.data.jadwal;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    editJadwal(id) {
      this.$router.push({
        name: "edit-jadwal",
        params: { kd_jadwal: id },
      });
    },

    deleteJadwal(id) {
      axios
        .delete("http://127.0.0.1:8000/api/jadwal/" + id)
        .then(() => {
          this.refreshList();
        })
        .catch((e) => {
          console.log(e);
        });
    },

    refreshList() {
      this.loadDataJadwal();
    },
  },
};
</script>
