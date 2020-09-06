<template>
    <div>
        <!-- navbar -->
        <nav class="navbar navbar-expand-sm navbar-light bg-white shadow-sm">
            <a href="#" @click.prevent="" class="navbar-brand">BePresensi</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name:'home' }">
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name:'about' }">
                            About
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Content -->
        <div class="container">
            <router-view></router-view>
        </div>

        <!-- Footer -->
        <v-footer color="indigo" app>
            <span class="white--text">&copy; BePresensi</span>
        </v-footer>
    </div>
</template>