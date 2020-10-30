<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Data Rekapitulasi</div>
        <br />

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
                    :items="rekapitulasi"
                    :search="search"
                    show-group-by
                    :items-per-page="5">
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
      rekapitulasi: [],
      headers: [
        {
          text: "NIM",
          align: "start",
          sortable: true,
          groupable: false,
          value: "mahasiswa.nim",
        },
        {
          text: "Mahasiswa",
          align: "start",
          sortable: true,
          groupable: false,
          value: "mahasiswa.nama_mahasiswa",
        },
        {
          text: "Sakit",
          value: "sakit",
          sortable: true,
          groupable: false,
        },
        {
          text: "Izin",
          value: "izin",
          sortable: true,
          groupable: false,
        },
        {
          text: "Alfa",
          value: "alfa",
          sortable: true,
          groupable: false,
        },
        {
          text: "Status",
          value: "status.keterangan_rekapitulasi",
          sortable: true,
          groupable: false,
        },
      ],
    };
  },
  created() {
    this.loadDataRekap();
    document.title = "Rekapitulasi | BePresensi";
  },
  methods: {
    async loadDataRekap() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/rekapitulasi")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array kelas
          this.rekapitulasi = response.data.data.rekapitulasi;
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
