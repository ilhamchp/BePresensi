<template>
  <StaffTUForm
    :staffTU="staffTU"
    :id_user="id_user"
    :onSubmit="updateDataStaff"
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

  mounted() {
    const { kd_staff } = this.$route.params;
    console.log(kd_staff);
    this.load(kd_staff);
  },

  created() {
    this.loadDataUser();
  },

  methods: {
    load(id) {
      axios
      .get("http://127.0.0.1:8000/api/staff-tu/" + id)
      .then((staffTU) => {
        console.log(staffTU.data.data.staff);
        this.staffTU = staffTU.data.data.staff;
      });
    },

    async loadDataUser() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/user")
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
    async updateDataStaff() {
      // menampilkan loading
      this.isLoadingData = true;
      // console.log(this.form)

      // fetch data dari api menggunakan axios
      axios
        .put("http://127.0.0.1:8000/api/staff-tu/" + this.staffTU.kd_staff, this.staffTU, this.id_user)
        .then((response) => {
          // mengirim data hasil fetch ke varibale array matakuliah
          console.log(response.data);
          this.message = "The data was updated successfully!";
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