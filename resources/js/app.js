

window.Vue = require('vue');
require('./bootstrap');
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
window.Vue.use(Vuetify);
window.Vue.use(VueRouter);
import { routes } from './routes.js';
import 'vuetify/dist/vuetify.min.css';
const router = new VueRouter({
  routes,
  scrollBehavior (proudect, home, savedPosition) {
  return { x: 0, y: 0 }
}
});

import main from './components/main.vue';

const app = new Vue({
    el: '#app',
    router,
    render: h => h(main)
});
