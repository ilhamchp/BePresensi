<template>
    <div>
        <!-- Heading -->
        <div class="text-h4">Data User</div>
        <br />

        <!-- Button Data Baru -->
        <v-btn color to=/tambah-user>
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
                    :items="user"
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
            user: [],
            headers: [
                {
                    text: "Email User",
                    align: "start",
                    sortable: true,
                    groupable: false,
                    value: "email"
                },
                {
                    text: "ID User",
                    value: "id",
                    sortable: true,
                    groupable: false
                }
            ]
        };
    },
    created() {
        this.loadDataUser();
        document.title = "User | BePresensi";
    },
    methods: {
        async loadDataUser() {
            // menampilkan loading
            this.isLoadingData = true;

            // fetch data dari api menggunakan axios
            axios
                .get("http://127.0.0.1:8000/api/user")
                .then(response => {
                    // mengirim data hasil fetch ke varibale array persons
                    this.user = response.data.data.user;
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
