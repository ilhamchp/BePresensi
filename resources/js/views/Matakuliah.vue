<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Data Matakuliah</div>
        <br />

        <!-- Button Data Baru -->
        <v-btn color to=/tambah-matakuliah>
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
                    :items="matakuliah"
                    :search="search"
                    show-group-by
                    :items-per-page="5">

                    <template v-slot:[`item.actions`]="{ item }">
                        <v-icon small class="mr-2" @click="editMatakuliah(item.kd_matakuliah)">mdi-pencil</v-icon>
                        <v-icon small @click="deleteMatakuliah(item.kd_matakuliah)">mdi-delete</v-icon>
                    </template>

                    <!-- <template v-slot:[`item.actions`]="{item}">
                      <v-btn 
                      :to = "{
                        name: 'edit-matakuliah',
                        params: {
                          kd_matakuliah: item.kd_matakuliah
                          }
                        }"
                        color="orange">Edit</v-btn>
                    </template> -->

                </v-data-table>
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
      matakuliah: [],
      headers: [
        {
          text: "Kode Matakuliah",
          align: "start",
          sortable: true,
          groupable: false,
          value: "kd_matakuliah",
        },
        {
          text: "Nama Matakuliah",
          value: "nama_matakuliah",
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
    this.loadDataMatkul();
    document.title = "Matakuliah | BePresensi";
  },
  methods: {
    async loadDataMatkul() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/matakuliah")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array matakuliah
          this.matakuliah = response.data.data.matakuliah;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },

    editMatakuliah(id) {
      this.$router.push({
        name: "edit-matakuliah",
        params: { kd_matakuliah: id },
      });
    },

    deleteMatakuliah(id) {
      axios
        .delete(
          "http://127.0.0.1:8000/api/matakuliah/" + id
        )
        .then(() => {
          this.refreshList();
        })
        .catch((e) => {
          console.log(e);
        });
    },

    refreshList() {
      this.loadDataMatkul();
    },

  },
};
</script>
