import './main.scss';
import Vue from 'vue';
import store from './store/index.js';
import Router from './router.js';
import Main from './templates/main.vue';
import axios from 'axios';

/* Import Global Components */
import icon from './elements/icon.vue';

Vue.prototype.$http = axios;

Vue.component('icon', icon)

new Vue({
  el: '#main',
  router: Router,
  store,
  render: (h) => h(Main),
});

new Vue({
  router: Router
}).$mount('#site-navigation')
