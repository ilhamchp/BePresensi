<template>
    <div class="Home">
    <h1 class="subheading grey--text">Dashboard Utama</h1>
    <v-container class="my-5">
        <v-layout row wrap>
            <v-flex xs12 sm6 md4 lg3 v-for="(item, i) in items" :key="i">
                <v-card flat class="ma-3">
                    <v-card-text>
                        <div class="subheading">{{item.title}}</div>
                        <div class="headline">{{item.data}}</div>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
    </div>
</template>

<script>
  export default {
    data: () => ({
      items: [
        {
          color: '#1F7087',
          title: 'Persentase Kehadiran',
          data: '92%',
        },
        {
          color: '#952175',
          title: 'Jumlah Surat Masuk',
          data: '5 Surat',
        },
        {
          color: '#952175',
          title: 'Jumlah Matkul Hari Ini',
          data: '9 Matkul',
        },
        {
          color: '#952175',
          title: 'Minggu Perkuliahan',
          data: 'Minggu 3',
        },
        {
          color: '#1F7087',
          title: 'Mahasiswwa SP-1',
          data: '3 Orang',
        },
        {
          color: '#952175',
          title: 'Mahasiswa SP-2',
          data: '0 Orang',
        },
        {
          color: '#952175',
          title: 'Mahasiswa SP-3',
          data: '1 Orang',
        },
        {
          color: '#952175',
          title: 'Mahasiswa DO',
          data: '0 Orang',
        },
      ],
    }),
  }
</script>