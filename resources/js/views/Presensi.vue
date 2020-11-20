<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Data Presensi</div>
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
                    :items="kehadiran"
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
      kehadiran: [],
      headers: [
        {
          text: "NIM",
          align: "start",
          sortable: true,
          groupable: false,
          value: "nim",
        },
        {
          text: "Kode Jadwal",
          value: "kd_jadwal",
          sortable: true,
          groupable: false,
        },
        {
          text: "Kode Sesi",
          value: "kd_sesi",
          sortable: true,
          groupable: false,
        },
        {
          text: "Status Presensi",
          value: "kd_status_presensi",
          sortable: true,
          groupable: false,
        },
      ],
    };
  },
  created() {
    this.loadDataPresensi();
    document.title = "Presensi | BePresensi";
  },
  methods: {
    async loadDataPresensi() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/kehadiran")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array persons
          this.kehadiran = response.data.data.kehadiran;
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
