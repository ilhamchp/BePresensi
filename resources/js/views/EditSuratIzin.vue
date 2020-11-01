<template>
  <SuratIzinForm
    :surat_izin="surat_izin"
    :nim="nim"
    :kd_status_presensi="kd_jenis_izin"
    :status_surat="status_surat"
    :onSubmit="updateDataSurat"
  ></SuratIzinForm>
</template>

<script>
import moment from "moment";
import { format, parseISO } from "date-fns";
import SuratIzinForm from "./SuratIzinForm";

export default {
  components: {
    SuratIzinForm,
  },

  data() {
    return {
      // menu: false,
      // menu2: false,
      // menu3: false,
      // menu4: false,
      kd_jenis_izin: [],
      nim: [],
      status_surat: [],
      surat_izin: {
        // kd_jenis_izin: "",
        // nim: "",
        // kd_surat_izin: "",
        tgl_mulai: "", //format(parseISO(new Date().toISOString()),'yyyy-M-d'),
        tgl_selesai: "", //format(parseISO(new Date().toISOString()),'yyyy-M-d'),
        // kd_status_surat: "",
        // catatan_surat: null,
        // catatan_wali_dosen: null,
        // jam_mulai: "",
        // jam_selesai: "",
        foto_surat: "",
      },
    };
  },

  created() {
    this.loadDataMahasiswa();
    this.loadDataStatusPresensi();
    this.loadDataStatusSurat();
  },
  mounted() {
    const { kd_surat_izin } = this.$route.params;
    console.log(kd_surat_izin);
    this.load(kd_surat_izin);
  },

  computed: {
    computedDateFormattedMomentjs() {
      return this.surat_izin.tgl_mulai
        ? moment(this.surat_izin.tgl_mulai).format("YYYY-M-D")
        : "";
    },
    computedDateFormattedMomentjs2() {
      return this.surat_izin.tgl_selesai
        ? moment(this.surat_izin.tgl_selesai).format("YYYY-M-D")
        : "";
    },
  },

  methods: {
    load(id) {
      axios
      .get("http://127.0.0.1:8000/api/surat-izin/" + id)
      .then((surat_izin) => {
        console.log(surat_izin.data.data.surat_izin);
        this.surat_izin = surat_izin.data.data.surat_izin;
      });
    },

    async loadDataMahasiswa() {
      // menampilkan loading
      this.isLoadingData = true;

      // fetch data dari api menggunakan axios
      axios
        .get("http://127.0.0.1:8000/api/mahasiswa")
        .then((response) => {
          // mengirim data hasil fetch ke varibale array surat izin
          this.nim = response.data.data.mahasiswa;
        })
        .catch((e) => {
          console.log(e);
        })
        .finally(() => {
          // mengakhiri loading
          this.isLoadingData = false;
        });
    },
    async loadDataStatusPresensi() {
      axios
        .get("http://127.0.0.1:8000/api/status-presensi")
        .then((response) => {
          this.kd_jenis_izin = response.data.data.status_presensi;
        });
    },
    async loadDataStatusSurat() {
      axios.get("http://127.0.0.1:8000/api/status-surat")
      .then((response) => {
        this.status_surat = response.data.data.status_surat;
      });
    },
    async updateDataSurat() {
      // menampilkan loading
      this.isLoadingData = true;
      console.log(this.surat_izin);

      // fetch data dari api menggunakan axios
      axios
        .put(
          "http://127.0.0.1:8000/api/surat-izin/" + this.surat_izin.kd_surat_izin,
          this.surat_izin,
          this.nim,
          this.kd_jenis_izin,
          this.status_surat
        )
        .then((response) => {
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