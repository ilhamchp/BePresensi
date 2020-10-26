<template>
  <StaffTUForm
    :staffTU="staffTU"
    :id_user="id_user"
    :onSubmit="addDataStaff"
  ></StaffTUForm>
</template>

<script>
import StaffTUForm from "./StaffTUForm";

export default {
  components: {
    StaffTUForm,
  },

  data() {
    return {
      id_user: [],
      staffTU: {
        kd_staff: "",
        nama_staff: "",
        foto_staff: "",
      },
    };
  },
  created() {
    this.loadDataUser();
  },
  methods: {
    async loadDataUser() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/dropdown-user")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array surat izin
          this.id_user = response.data.data.user;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },
    async addDataStaff() {
      // menampilkan loading
      this.isLoadingData = true;
      // console.log(this.form)

      // fetch data dari api menggunakan axios
      axios
        .post("http://127.0.0.1:8000/api/staff-tu", this.staffTU, this.id_user)
        .then((response) => {
          // mengirim data hasil fetch ke varibale array matakuliah
          this.load();
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