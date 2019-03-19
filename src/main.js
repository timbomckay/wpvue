import './main.scss';
import 'babel-polyfill';
import Vue from 'vue';
import axios from 'axios';
import store from './store';
import Router from './router.js';
import Main from './templates/main.vue';

/* Import Global Components */
import icon from './elements/icon.vue';

Vue.prototype.$http = axios;

Vue.component('icon', icon);

new Vue({
  el: '#main',
  router: Router,
  store,
  render: (h) => h(Main),
});

new Vue({
  router: Router,
  store
}).$mount('#site-navigation');
