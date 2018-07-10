import './main.scss';
import Vue from 'vue';
import Router from './router.js';
import Main from './templates/main.vue';
import axios from 'axios';

import icon from './elements/icon.vue';

Vue.prototype.$http = axios;

Vue.component('icon', icon)

new Vue({
  el: '#main',
  router: Router,
  render: (h) => h(Main),
});

new Vue({
  router: Router
}).$mount('#site-navigation')
