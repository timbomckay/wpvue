import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store/index.js';

Vue.use(VueRouter);

const BLOG_URL = site.blog.slug

// TODO: 404 page
// TODO: Search Page & Results
// TODO: Dynamic routes from post_types/rest_routes
// TODO: Account for blog being the home page
// TODO: Child Routes

const routes = [
  { // front-page
    name: 'home',
    path: '/',
    meta: {
      route: 'pages',
      id: site.home.id
    },
    component: () => import(/* webpackChunkName: "front-page" */'./templates/front-page.vue')
  }, { // blog pages
    name: 'blog',
    path: `/${BLOG_URL}`,
    meta: {
      route: 'pages',
      archive: 'posts',
      id: site.blog.id
    },
    component: () => import(/* webpackChunkName: "archive" */'./templates/archive.vue')
  }, {
    path: `/${BLOG_URL}/page/:page(\\d+)?`,
    meta: {
      route: 'posts',
      archive: 'posts'
    },
    component: () => import(/* webpackChunkName: "archive" */'./templates/archive.vue')
  }, {
    name: 'post',
    path: `/${BLOG_URL}/:slug`,
    meta: { route: 'posts' },
    component: () => import(/* webpackChunkName: "post" */'./templates/posts.vue')
  }, {
    path: `/${BLOG_URL}/:taxonomy/:slug`,
    meta: { route: 'posts' },
    component: () => import(/* webpackChunkName: "archive" */'./templates/archive.vue')
  }, {
    path: `/${BLOG_URL}/:taxonomy/:slug/page/:page(\\d+)?`,
    meta: { route: 'posts' },
    component: () => import(/* webpackChunkName: "archive" */'./templates/archive.vue')
  }, {
    name: 'page',
    path: '/(:ancestor/)?(:great/)?(:grand/)?(:parent/)?:slug',
    meta: { route: 'pages' },
    component: () => import(/* webpackChunkName: "page" */'./templates/pages.vue')
  }
];

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'nav-item-active', // a css class indicating route anchor active state, applies to ancestor, parent & exact
  linkExactActiveClass: 'nav-link-active', // a css class indicating route anchor active state, only applies to exact/single link
  routes: routes,
  scrollBehavior(to) {
    return window.scrollTo({
      top: to.hash ? document.querySelector(to.hash).offsetTop : 0,
      behavior: 'smooth'
    });
  }
});

export default router;
