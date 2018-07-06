import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }

const routes = [
  { path: '/', name: 'home', component: Bar },
  { path: '/:slug', name: 'page', component: Foo }
]

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'active', // a css class indicating route anchor active state
  routes: routes
});

export default router;
