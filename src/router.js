import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const router = new Router({
  mode: 'history',
  linkActiveClass: 'active', // a css class indicating route anchor active state
  routes: [

  ]
});

router.map({
  '/': {
    name: 'home',
    component: resolve => {
      require([`./views/${this.name}.vue`], resolve);
    }
  },
  '/posts/:postid/': {
    name: 'posts',
    component: resolve => {
      require([`./views/${this.name}.vue`], resolve);
    }
  }
});

export default router;
