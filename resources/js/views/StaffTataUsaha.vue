<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Data Staff TU</div>
        <br />

        <!-- Button Data Baru -->
        <v-btn color>
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
                    :items="staffTU"
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
            staffTU: [],
            headers: [
                {
                    text: "Kode Staff TU",
                    align: "start",
                    sortable: true,
                    groupable: false,
                    value: "kd_staff"
                },
                {
                    text: "Nama Staff TU",
                    value: "nama_staff",
                    sortable: true,
                    groupable: false
                },
                {
                    text: "ID User",
                    value: "id_user",
                    sortable: true,
                    groupable: false
                }
            ]
        };
    },
    created() {
        this.loadDataStaffTU();
        document.title = "Staff Tata Usaha | BePresensi";
    },
    methods: {
        async loadDataStaffTU() {
            // menampilkan loading
            this.isLoadingData = true;

            // fetch data dari api menggunakan axios
            axios
                .get("http://127.0.0.1:8000/api/staff-tu")
                .then(response => {
                    // mengirim data hasil fetch ke varibale array beacon
                    this.staffTU = response.data.data.staff_tata_usaha;
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
