<template>
    <v-app id="inspire">
        <!-- Navigation Bar -->
        <v-navigation-drawer
            v-model="drawer"
            :clipped="$vuetify.breakpoint.lgAndUp"
            app
        >
            <v-list dense>
                <template v-for="item in items">

                    <!-- Menu Heading -->
                    <v-row
                        v-if="item.heading"
                        :key="item.heading"
                        align="center"
                    >
                        <v-col cols="6">
                            <v-subheader v-if="item.heading">
                                {{ item.heading }}
                            </v-subheader>
                        </v-col>
                        <v-col
                            cols="6"
                            class="text-center"
                        >
                            <a
                                href="#!"
                                class="body-2 black--text"
                            >EDIT</a>
                        </v-col>
                    </v-row>

                    <!-- Sub Menu -->
                    <v-list-group
                        v-else-if="item.children"
                        :key="item.text"
                        v-model="item.model"
                        :prepend-icon="item.model ? item.icon : item['icon-alt']"
                        append-icon=""
                        style="text-decoration:none"
                    >
                        <template v-slot:activator>
                            <v-list-item-content>
                                <v-list-item-title>
                                {{ item.text }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </template>
                        <v-list-item
                            v-for="(child, i) in item.children"
                            :key="i"
                            link
                            :to="child.link"
                            style="text-decoration:none"
                        >
                            <v-list-item-action v-if="child.icon">
                                <v-icon>{{ child.icon }}</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>
                                    <a>
                                    {{ child.text }}
                                    </a>
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>

                    <!-- Sub Menu Text -->
                    <v-list-item
                        v-else
                        :key="item.text"
                        link
                        :to="item.link"
                        style="text-decoration:none"
                    >
                        <v-list-item-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <a>
                                {{ item.text }}
                                </a>
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>

        <!-- Application Bar -->
        <v-app-bar
            :clipped-left="$vuetify.breakpoint.lgAndUp"
            app
            color="#03A9F4"
            dark
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title
                style="width: 300px"
                class="ml-0 pl-4"
            >
                <span class="hidden-sm-and-down">BePresensi</span>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon>
                <v-icon>mdi-apps</v-icon>
            </v-btn>
            <v-btn icon>
                <v-icon>mdi-bell</v-icon>
            </v-btn>
            <v-btn
                icon
                large
            >
                <v-avatar
                    size="32px"
                    item
                >
                    <v-img
                        src="https://cdn.vuetifyjs.com/images/logos/logo.svg"
                        alt="Vuetify"
                    ></v-img>
                </v-avatar>
            </v-btn>
        </v-app-bar>

        <!-- Content -->
        <v-main
            style="background: #F5F5F5;"
        >
            <v-container
                class="ma-3"
                fluid
            >
                <v-row
                    align="start"
                    justify="start"
                >
                    <transition name="fade">
                        <router-view></router-view>
                    </transition>
                </v-row>
            </v-container>
        </v-main>

        <!-- Footer -->
        <v-footer
            color="#03A9F4"
            app
        >
            <span class="white--text">KoTA 205 &copy; 2020</span>
        </v-footer>
    </v-app>
</template>

<script>
  export default {
    props: {
      source: String,
    },
    data: () => ({
      dialog: false,
      drawer: null,
      items: [
        { icon: 'mdi-home', text: 'Home', link:'/'},
        { icon: 'mdi-mouse-bluetooth', text: 'Beacon', link:'/beacon'},
        { icon: 'mdi-account-tie', text: 'Dosen', link:'/dosen'},
        { icon: 'mdi-calendar-clock', text: 'Jadwal Matakuliah', link:'/jadwal-matakuliah'},
        { icon: 'mdi-google-classroom', text: 'Kelas', link:'/kelas'},
        { icon: 'mdi-account-group', text: 'Mahasiswa', link:'/mahasiswa'},
        { icon: 'mdi-teach', text: 'Matakuliah', link:'/matakuliah'},
        { icon: 'mdi-clock-start', text: 'Sesi', link:'/sesi'},
        { icon: 'mdi-notebook-check', text: 'Presensi', link:'/presensi'},
        { icon: 'mdi-notebook-check', text: 'Rekapitulasi', link:'/rekapitulasi'},
        { icon: 'mdi-teach', text: 'Ruang', link:'/ruang'},
        { icon: 'mdi-account-details', text: 'Staff Tata Usaha', link:'/staff-tata-usaha'},
        { icon: 'mdi-email-multiple', text: 'Surat Izin', link:'/surat-izin'},
        { icon: 'mdi-account-cog', text: 'User', link:'/user'},

        // {
        //   icon: 'mdi-chevron-up',
        //   'icon-alt': 'mdi-chevron-down',
        //   text: 'Labels',
        //   model: true,
        //   children: [
        //     { icon: 'mdi-plus', text: 'Create label', link:'/2'},
        //   ],
        // },
        // {
        //   icon: 'mdi-chevron-up',
        //   'icon-alt': 'mdi-chevron-down',
        //   text: 'More',
        //   model: false,
        //   children: [
        //     { text: 'Import', link:'/3'},
        //     { text: 'Export', link:'/4'},
        //     { text: 'Print', link:'/5'},
        //     { text: 'Undo changes', link:'/6'},
        //     { text: 'Other contacts', link:'/7'},
        //   ],
        // }
      ],
    }),
  }
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition-property: opacity;
  transition-duration: .25s;
}

.fade-enter-active {
  transition-delay: .25s;
}

.fade-enter, .fade-leave-active {
  opacity: 0
}
</style>