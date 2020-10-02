<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Data Dosen</div>
        <br />

        <!-- Button Data Baru -->
        <v-btn color to=/tambah-dosen>
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
                    :items="dosen"
                    :search="search"
                    show-group-by
                    :items-per-page="5">

                    <template v-slot:[`item.actions`]="{ item }">
                        <v-icon small class="mr-2">mdi-pencil</v-icon>
                        <v-icon small @click="deleteDosen(item.kd_dosen)">mdi-delete</v-icon>
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
      dosen: [],
      headers: [
        {
          text: "Nama Dosen",
          align: "start",
          sortable: true,
          groupable: false,
          value: "nama_dosen",
        },
        {
          text: "Kode Dosen",
          value: "kd_dosen",
          sortable: true,
          groupable: false,
        },
        {
          text: "ID User",
          value: "id_user",
          sortable: true,
          groupable: false,
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
    this.loadDataDosen();
    document.title = "Dosen | BePresensi";
  },
  methods: {
    async loadDataDosen() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/dosen")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array persons
          this.dosen = response.data.data.dosen;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    deleteDosen(id) {
      axios
        .delete("http://127.0.0.1:8000/api/dosen/" + id)
        .then(() => {
          this.refreshList();
        })
        .catch((e) => {
          console.log(e);
        });
    },

    refreshList() {
      this.loadDataDosen();
    },
  },
};
</script>
