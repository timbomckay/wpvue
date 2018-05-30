import Vue from 'vue';
import router from './router.js';
import app from './app.vue';

import icon from '../elements/icon.vue'
Vue.component('icon', icon)

new Vue({
  router,
  el: '#app',
  render: (h) => h(app),
});
