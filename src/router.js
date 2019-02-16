import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store/index.js';

Vue.use(VueRouter);

const BLOG_URL = site.blog ? `/${site.blog.slug}/` : '/';

const templates = {
  home: () => import(/* webpackChunkName: "front-page" */'./templates/front-page.vue'),
  archive: () => import(/* webpackChunkName: "archive" */'./templates/archive.vue'),
  post: () => import(/* webpackChunkName: "post" */'./templates/post.vue'),
  page: () => import(/* webpackChunkName: "page" */'./templates/page.vue')
}

// TODO: 404 page
// TODO: Search Page & Results
// TODO: Dynamic routes from post_types/rest_routes
// TODO: Account for blog being the home page

const routes = [{ // front-page
  name: 'home',
  path: '/',
  component: templates.home,
  meta: {
    route: 'pages',
    id: site.home.id
  }
}];

// Archives
[ 'category/:slug',
  'tag/:slug',
  'author/:slug',
  ':year([0-9]{4})/:month([0-9]{1,2})/:day([0-9]{1,2})', // Year Month Day Archive
  ':year([0-9]{4})/:month([0-9]{1,2})', // Year Month Archive
  ':year([0-9]{4})' // Year Archive
].forEach((x,i) => {
  const names = ['category', 'tag', 'author', 'day', 'month', 'year']
  routes.push({
    name: `archive-${names[i]}`,
    path: BLOG_URL + x,
    component: templates.archive,
    meta: {
      route: 'posts',
      archive: 'posts'
    }
  });
});

// Permalink Based Routes
site.permalinks
  .replace('%postname%', ':slug') // rename postname to slug
  .replace('%post_id%', ':id') // rename post_id to id
  .replace(/\/%/g, '/:') // replace first % of each param with vue-router syntax
  .replace(/%\//g, '/') // remove closing % of each param
  .split('/') // create array of url parameters
  .filter(x => x) // remove empty values
  .forEach((p, i, arr) => {
    let params = arr.slice().reverse().slice(i).reverse();

    const route = {
      name: params.join('-').replace(/:/g, ''),
      path: `/${params.join('/')}/`,
      component: templates.archive,
      meta: {
        route: 'posts',
        archive: 'posts'
      }
    }

    // single article --> i = 0
    if (!i) {
      route.name = 'post';
      route.meta.archive = false;
    }

    // blog at root
    if (BLOG_URL && (i + 1 === arr.length)) {
      route.meta.route = 'pages';
      route.meta.id = site.blog.id;
    }

    routes.push(route);
  });

// Search Results
routes.push({
  name: 'search',
  path: '/search/:q',
  component: templates.archive
});

// Pages
routes.push({
  name: 'page',
  path: '/:ancestor?/:great?/:grand?/:parent?/:slug',
  meta: { route: 'pages' },
  component: templates.page
});

// Paginate Routes
routes.slice().forEach((e,i,arr) => {
  const route = Object.assign({}, e);
  route.name = `${e.name}-paged`;
  route.path = `${e.path}page/:page(\\d+)/`;
  routes.splice(i * 2, 0, route);
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
