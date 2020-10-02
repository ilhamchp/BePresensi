<template>
  <v-row justify="center">
    <v-col
      cols="12"
      sm="10"
      md="8"
      lg="6"
    >
      <v-card ref="form">
        <v-card-text>
          <v-text-field
            ref="nama-matkul"
            v-model="currentForm.nama_matakuliah"
            label="Nama Mata Kuliah"
            required
          ></v-text-field>
        </v-card-text>
        <v-divider class="mt-12"></v-divider>
        <v-card-actions>
          <v-btn text to=/matakuliah>
            Cancel
          </v-btn>
          <v-spacer></v-spacer>

          <v-btn
            color="primary"
            text
            @click="updateData(item.kd_matakuliah)"
          >
            Submit
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      message: "",
      currentForm: {
        nama_matakuliah: "",
      },
    };
  },
  methods: {
    getMatakuliah(id) {
        DataService.get(id)
            .then((response) => {
                this.currentForm = response.data.data.matakuliah;
                console.log(response.data.data.matakuliah);
            })
            .catch((e) => {
                console.log(e);
            });
    },
    // async loadDataMatkul() {
    //     // menampilkan loading
    //     this.isLoadingData = true;

    //     // fetch data dari api menggunakan axios
    //     axios
    //         .get("http://127.0.0.1:8000/api/matakuliah" + kd_matakuliah)
    //         .then(response => {
    //             // mengirim data hasil fetch ke varibale array matakuliah
    //             this.matakuliah = response.data.data.matakuliah;
    //         })
    //         .catch(e => {
    //             console.log(e);
    //         })
    //         .finally(() => {
    //             // mengakhiri loading
    //             this.isLoadingData = false;
    //         });
    // },

    async updateData(id) {
      // console.log(this.currentForm);
      // DataService.update(this.currentForm.kd_matakuliah, this.currentForm)
      axios
        .put(
          "http://127.0.0.1:8000/api/matakuliah/" + id,
          this.currentForm
        )
        .then((response) => {
          console.log(response.data);
          this.message = "The data was updated successfully!";
        })
        .catch((e) => {
          console.log(e);
        });
    },

    async getSingleData(id) {
        axios.get('http://127.0.0.1:8000/api/matakuliah/' + id)
        .then(response => {
          this.currentForm.nama_matakuliah = response.data.data.matakuliah;
        })
        .catch((e) => {
          console.log(e);
        })
    },
    mounted() {
    //     this.message = "";
        this.getMatakuliah(this.$route.params.id)
    },
  },
};
</script>