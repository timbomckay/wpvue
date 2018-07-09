import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const Page = { template: '<div>Page</div>' }
const Home = { template: '<div>Home</div>' }

const routes = [
  { path: '/', name: 'home', component: Home },
  //  default pages
  { path: '/:slug', name: 'page', component: Page },
  { path: '/:parent/:slug', name: 'page', component: Page },
  { path: '/:ancestor/:parent/:slug', name: 'page', component: Page }
]

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'active', // a css class indicating route anchor active state, applies to ancestor, parent & exact
  linkExactActiveClass: 'active', // a css class indicating route anchor active state, only applies to exact/single link
  routes: routes
});

export default router;
