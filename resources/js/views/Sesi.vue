<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Data Sesi</div>
        <br />

        <!-- Button Data Baru -->
        <v-btn color to=/tambah-sesi>
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
                    :items="sesi"
                    :search="search"
                    show-group-by
                    :items-per-page="5">

                    <template v-slot:[`item.actions`]="{ item }">
                        <v-icon small class="mr-2" @click="editSesi(item.kd_sesi)">mdi-pencil</v-icon>
                        <v-icon small @click="deleteSesi(item.kd_sesi)">mdi-delete</v-icon>
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
      sesi: [],
      headers: [
        {
          text: "Kode Sesi",
          align: "start",
          sortable: true,
          groupable: false,
          value: "kd_sesi",
        },
        {
          text: "Jam Mulai",
          value: "jam_mulai",
          sortable: true,
          groupable: false,
        },
        {
          text: "Jam Berakhir",
          value: "jam_berakhir",
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
    this.loadDataSesi();
    document.title = "Sesi | BePresensi";
  },
  methods: {
    async loadDataSesi() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/sesi")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array kelas
          this.sesi = response.data.data.sesi;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    editSesi(id) {
      this.$router.push({
        name: "edit-sesi",
        params: { kd_sesi: id },
      });
    },

    deleteSesi(id) {
      axios
        .delete("http://127.0.0.1:8000/api/sesi/" + id)
        .then(() => {
          this.refreshList();
        })
        .catch((e) => {
          console.log(e);
        });
    },

    refreshList() {
      this.loadDataSesi();
    },
  },
};
</script>
