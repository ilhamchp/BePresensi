<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Data Surat</div>
        <br />

        <!-- Button Data Baru -->
        <v-btn color to=/tambah-surat-izin>
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
                    :items="surat"
                    :search="search"
                    show-group-by
                    :items-per-page="5"
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
            surat: [],
            headers: [
                {
                    text: "Kode Surat",
                    align: "start",
                    sortable: true,
                    groupable: false,
                    value: "kd_surat_izin"
                },
                {
                    text: "Keterangan Presensi",
                    value: "jenis_izin.keterangan_presensi",
                    sortable: true,
                    groupable: false
                }
                // {
                //     text: "Major",
                //     value: "major",
                //     sortable: true,
                //     groupable: false
                // },
                // {
                //     text: "Minor",
                //     value: "minor",
                //     sortable: true,
                //     groupable: false
                // }
            ]
        };
    },
    created() {
        this.loadDataSurat();
        document.title = "Surat | BePresensi";
    },
    methods: {
        async loadDataSurat() {
            // menampilkan loading
            this.isLoadingData = true;

            // fetch data dari api menggunakan axios
            axios
                .get("http://127.0.0.1:8000/api/surat-izin")
                .then(response => {
                    // mengirim data hasil fetch ke varibale array surat izin
                    this.surat = response.data.data.surat_izin;
                })
                .catch(e => {
                    console.log(e);
                })
                .finally(() => {
                    // mengakhiri loading
                    this.isLoadingData = false;
                });
        }
    }
};
</script>
