import './main.scss';
import Vue from 'vue';
// import Router from './router.js';
import Main from './templates/main.vue';

import icon from './elements/icon.vue'

Vue.component('icon', icon)

new Vue({
  el: '#main',
  render: (h) => h(Main),
});
