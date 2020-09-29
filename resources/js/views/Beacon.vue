<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Data Beacon</div>
        <br />

        <!-- Button Data Baru -->
        <v-btn color to=/tambah-edit-beacon>
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
                    :items="beacon"
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
            beacon: [],
            headers: [
                {
                    text: "Kode Beacon",
                    align: "start",
                    sortable: true,
                    groupable: false,
                    value: "kd_beacon"
                },
                {
                    text: "Mac Address",
                    value: "mac_address",
                    sortable: true,
                    groupable: false
                },
                {
                    text: "Major",
                    value: "major",
                    sortable: true,
                    groupable: false
                },
                {
                    text: "Minor",
                    value: "minor",
                    sortable: true,
                    groupable: false
                }
            ]
        };
    },
    created() {
        this.loadDataBeacon();
        document.title = "Beacon | BePresensi";
    },
    methods: {
        async loadDataBeacon() {
            // menampilkan loading
            this.isLoadingData = true;

            // fetch data dari api menggunakan axios
            axios
                .get("http://127.0.0.1:8000/api/beacon")
                .then(response => {
                    // mengirim data hasil fetch ke varibale array beacon
                    this.beacon = response.data.data.beacon;
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
