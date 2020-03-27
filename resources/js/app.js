import Vue from 'vue'
import Index from './Index'
import router from './Router/router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueSwal from 'vue-swal'
import auth from './auth'
import VueAuth from '@websanova/vue-auth'
import JQuery from 'jquery/dist/jquery.min'
import 'font-awesome/css/font-awesome.min.css'
import VueQrcode from '@chenfengyuan/vue-qrcode';
import SrBreadCrumbs from './helpers/SrBreadCrumbs';



// import VueMeta from 'vue-meta'
require('../sass/style.css');

Vue.component(VueQrcode.name,VueQrcode);
Vue.component("sr-bread-crumbs",SrBreadCrumbs);


// import VueMeta from 'vue-meta'
require('../sass/style.css');


window.$ = JQuery;
Vue.router = router;


// Set Vue authentication
Vue.use(VueAxios, axios);

axios.defaults.baseURL = `/api`;

window.Vue = require('vue');

import vuetify from './plugins/vuetify' // path to vuetify export

// Load Index
Vue.component('index', Index);
// Set Vue router
// Vue.router = router;
Vue.use(VueSwal);

Vue.use(VueAuth, auth);

const app = new Vue({
    el: '#app',
    vuetify,
    router,
});
