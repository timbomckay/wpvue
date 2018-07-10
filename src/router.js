import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const home = {
  name: 'Home',
  template: '<div>Home</div>'
}

const routes = [
  // front-page
  { path: '/', component: () => import('./templates/front-page.vue') },
  // blog pages
  { path: '/blog/:page(\\d+)?', component: () => import('./templates/archive.vue') },
	{ path: '/blog/category/:slug', component: () => import('./templates/archive.vue') },
	{ path: '/blog/tag/:slug', component: () => import('./templates/archive.vue') },
	{ path: '/blog/:slug', component: () => import('./templates/posts.vue') },
  //  default pages
  { path: '/:slug', component: () => import('./templates/pages.vue') },
  { path: '/:parent/:slug', component: () => import('./templates/pages.vue') },
  { path: '/:ancestor/:parent/:slug', component: () => import('./templates/pages.vue') }
]

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'nav-item-active', // a css class indicating route anchor active state, applies to ancestor, parent & exact
  linkExactActiveClass: 'nav-link-active', // a css class indicating route anchor active state, only applies to exact/single link
  routes: routes
});

export default router;
