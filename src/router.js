import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store/index.js';

Vue.use(VueRouter);

const templates = {
  home: () => import(/* webpackChunkName: "front-page" */'./templates/front-page.vue'),
  archive: () => import(/* webpackChunkName: "archive" */'./templates/archive.vue'),
  posts: () => import(/* webpackChunkName: "posts" */'./templates/posts.vue'),
  pages: () => import(/* webpackChunkName: "pages" */'./templates/pages.vue')
}

const BLOG_URL = site.blog.slug

// TODO: 404 page
// TODO: Search Page & Results
// TODO: Dynamic routes from post_types/rest_routes
// TODO: Account for blog being the home page

const routes = [
  { // front-page
    name: 'home',
    path: '/',
    meta: {
      route: 'pages',
      id: site.home.id
    },
    component: templates.home
  }
];

// Blog Permalink Based Routes

site.permalinks
  .replace('%postname%', ':slug') // rename postname to slug
  .replace('%post_id%', ':id') // rename post_id to id
  .replace(/\/%/g, '/:') // replace first % of each param with vue-router syntax
  .replace(/%\//g, '/') // remove closing % of each param
  .split('/') // create array of url parameters
  .filter(x => x) // remove empty values
  .forEach((p, i, arr) => {
    let params = arr.slice().reverse().slice(i).reverse();
      params = `/${params.join('/')}/`;

    const route = {
      component: templates[!i ? 'posts' : 'archive'],
      meta: {
        route: 'posts',
        archive: !i ? false : 'posts'
      }
    }

    routes.push(Object.assign({
      path: `${params}page/:page(\\d+)/`
    }, route));

    if (!i) {
      route.name = 'post';
    }

    if (i + 1 === arr.length) {
      route.name = 'blog';
      route.component = templates.pages;
      route.meta.route = 'pages';
      route.meta.id = site.blog.id;
    }

    routes.push(Object.assign({
      path: params
    }, route));
  });


// Pages

routes.push({
  name: 'page',
  path: '/:ancestor?/:great?/:grand?/:parent?/:slug',
  meta: { route: 'pages' },
  component: templates.pages
});

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
