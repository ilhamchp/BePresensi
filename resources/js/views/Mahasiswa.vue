<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Data Mahasiswa</div>
        <br />

        <!-- Button Data Baru -->
        <v-btn color to=/tambah-mahasiswa>
            <div class="text-overline">Tambah Data Baru</div>
        </v-btn>
        <br />
        <br />
        <!-- Card Data Table -->
        <v-card
            loading="isLoadingData"
        >
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
                    :items="mahasiswa"
                    :search="search"
                    :key="mahasiswa.nim"
                    show-group-by
                    :items-per-page="5">

                    <template v-slot:[`item.actions`]="{ item }">
                        <v-icon small class="mr-2">mdi-pencil</v-icon>
                        <v-icon small @click="deleteMahasiswa(item.nim)">mdi-delete</v-icon>
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
      mahasiswa: [],
      headers: [
        {
          text: "Nama Mahasiswa",
          align: "start",
          sortable: true,
          groupable: false,
          value: "nama_mahasiswa",
        },
        { text: "NIM", value: "nim", sortable: true, groupable: false },
        {
          text: "ID User",
          value: "id_user",
          sortable: true,
          groupable: false,
        },
        {
          text: "Kode Kelas ",
          value: "kd_kelas",
          sortable: true,
          groupable: true,
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
    this.loadDataMhs();
    document.title = "Mahasiswa | BePresensi";
  },
  methods: {
    async loadDataMhs() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/mahasiswa")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array persons
          this.mahasiswa = response.data.data.mahasiswa;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    deleteMahasiswa(id) {
      axios
        .delete("http://127.0.0.1:8000/api/mahasiswa/" + id)
        .then(() => {
          this.refreshList();
        })
        .catch((e) => {
          console.log(e);
        });
    },

    refreshList() {
      this.loadDataMhs();
    },
  },
};
</script>
