<template>
    <div class="Home">
    <h1 class="subheading grey--text">Jadwal Mata Kuliah</h1>
    <v-container class="my-5">
        <v-layout row wrap>
            <v-flex xs12 sm6 md4 lg3 v-for="(item, i) in items" :key="i">
                <v-card class="ma-3">
                    <v-card-text>
                        <div class="headline">{{item.kelas}}</div>
                        <div class="subheading">{{item.kdkelas}}</div>
                        <div class="subheading">Jumlah Mahasiswa : {{item.jmlhmhs}}</div>
                        <div class="subheading">Wali Kelas : {{item.walikls}}</div>
                        <div class="text-center"><v-btn class="ma-2" outlined color="indigo">SUNTING</v-btn></div>
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
          kelas: 'Kelas 3A',
          kdkelas: 'D3A2017',
          jmlhmhs: '32 Orang',
          walikls: 'Rinaldi Munir',
        },
        {
          color: '#952175',
          kelas: 'Kelas 3A',
          kdkelas: 'D3A2017',
          jmlhmhs: '32 Orang',
          walikls: 'Rinaldi Munir',
        },
        {
          color: '#952175',
          kelas: 'Kelas 3A',
          kdkelas: 'D3A2017',
          jmlhmhs: '32 Orang',
          walikls: 'Rinaldi Munir',
        },
        {
          color: '#952175',
          kelas: 'Kelas 3A',
          kdkelas: 'D3A2017',
          jmlhmhs: '32 Orang',
          walikls: 'Rinaldi Munir',
        },
      ],
    }),
  }
</script>