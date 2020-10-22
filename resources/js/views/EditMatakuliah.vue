<template>
  <MatakuliahForm
    :matakuliah="matakuliah"
    :onSubmit="updateData"
  ></MatakuliahForm>
</template>

<script>
import MatakuliahForm from "./MatakuliahForm";

export default {
  components: {
    MatakuliahForm,
  },

  data() {
    return {
      message: "",
      matakuliah: {
        nama_matakuliah: "",
        kd_matakuliah: "",
      },
    };
  },

  mounted() {
    const { kd_matakuliah } = this.$route.params;
    console.log(kd_matakuliah);
    this.load(kd_matakuliah);
  },

  methods: {
    load(id) {
      axios
        .get("http://127.0.0.1:8000/api/matakuliah/" + id)
        .then((matakuliah) => {
          this.matakuliah = matakuliah;
        });
    },

    async updateData() {
      axios
        .put(
          "http://127.0.0.1:8000/api/matakuliah/" +
            this.matakuliah.kd_matakuliah,
          this.matakuliah
        )
        .then((response) => {
          console.log(response.data);
          this.message = "The data was updated successfully!";
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
};
</script>