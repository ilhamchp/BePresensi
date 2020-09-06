import './bootstrap'
import Vue from 'vue'
import router from './router'
import axios from 'axios'
import Vuetify from 'vuetify'

import App from './layouts/App.vue'

Vue.use(Vuetify);

const vm = new Vue({
    axios,
    router,
    vuetify: new Vuetify(),
    el: '#app',
    render: h=> h(App)
})
