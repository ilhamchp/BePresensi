<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Data Ruang</div>
        <br />

        <!-- Button Data Baru -->
        <v-btn color to=/tambah-ruang>
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
                    :items="ruang"
                    :search="search"
                    show-group-by
                    :items-per-page="5">

                    <template v-slot:[`item.actions`]="{ item }">
                        <v-icon small class="mr-2" @click="editRuang(item.kd_ruang)">mdi-pencil</v-icon>
                        <v-icon small @click="deleteRuang(item.kd_ruang)">mdi-delete</v-icon>
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
      ruang: [],
      headers: [
        {
          text: "Kode Ruang",
          align: "start",
          sortable: true,
          groupable: false,
          value: "kd_ruang",
        },
        {
          text: "Nama Ruang",
          value: "nama_ruang",
          sortable: true,
          groupable: false,
        },
        {
          text: "Kode Beacon",
          value: "kd_beacon",
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
    this.loadDataRuang();
    document.title = "Ruang | BePresensi";
  },
  methods: {
    async loadDataRuang() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/ruang")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array kelas
          this.ruang = response.data.data.ruang;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    editRuang(id) {
      this.$router.push({
        name: "edit-ruang",
        params: { kd_ruang: id },
      });
    },

    deleteRuang(id) {
      axios
        .delete("http://127.0.0.1:8000/api/ruang/" + id)
        .then(() => {
          this.refreshList();
        })
        .catch((e) => {
          console.log(e);
        });
    },

    refreshList() {
      this.loadDataRuang();
    },
  },
};
</script>
