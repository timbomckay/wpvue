import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store';

Vue.use(VueRouter);

const BLOG_URL = site.blog ? `/${site.blog.slug}/` : '/';

const templates = {
  home: () => import(/* webpackChunkName: "home" */'./templates/home.vue'),
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
    id: site.home.id,
    slug: site.home.slug
  }
}];

// Date Archives
[ 'category/:slug/',
  'tag/:slug/',
  'author/:slug/',
  ':year([0-9]{4})/:month([0-9]{1,2})/:day([0-9]{1,2})/', // Year Month Day Archive
  ':year([0-9]{4})/:month([0-9]{1,2})/', // Year Month Archive
  ':year([0-9]{4})/' // Year Archive
].forEach((x,i) => {
  const names = ['category', 'tag', 'author', 'day', 'month', 'year'];
  const taxRoutes = ['categories', 'tags', 'users'];
  routes.push({
    name: `archive-${names[i]}`,
    path: BLOG_URL + x,
    component: templates.archive,
    meta: {
      route: taxRoutes[i] || false,
      archive: 'posts'
    }
  });
});

// Permalink Based Routes
site.permalinks.base
  .replace('%postname%', ':slug') // rename postname to slug
  .replace('%post_id%', ':id') // rename post_id to id
  .replace(/\/%/g, '/:') // replace first % of each param with vue-router syntax
  .replace(/%\//g, '/') // remove closing % of each param
  .split('/') // create array of url parameters
  .filter(x => x) // remove empty values
  .forEach((p, i, arr) => {
    let params = arr.slice(0, i + 1);

    const route = {
      name: params.join('-').replace(/:/g, ''),
      path: `/${params.join('/')}/`,
      component: templates.archive,
      meta: {
        archive: 'posts'
      }
    }

    // single article --> i = 0
    if (i + 1 === arr.length) {
      route.name = 'post';
      route.component = templates.post;
      route.meta.route = 'posts';
      route.meta.archive = false;
    }

    // blog at root
    if (BLOG_URL && !i) {
      route.meta.route = 'pages';
      route.meta.id = site.blog.id;
      route.meta.slug = site.blog.slug;
    }

    routes.push(route);
  });

// Search Results
routes.push({
  name: 'search',
  path: '/search/:q/',
  component: templates.archive
});

// Pages
routes.push({
  name: 'page',
  path: '/:ancestor?/:great?/:grand?/:parent?/:slug/',
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

// enforce trailing slash
routes.map(x => x.pathToRegexpOptions = { strict: true } );

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'nav-item-active', // a css class indicating route anchor active state, applies to ancestor, parent & exact
  linkExactActiveClass: 'nav-link-active', // a css class indicating route anchor active state, only applies to exact/single link
  routes: routes,
  scrollBehavior(to) {
    return window.scrollTo({
      top: to.hash ? document.querySelector(to.hash).offsetTop : 0,
      // behavior: 'smooth'
    });
  },
});

router.beforeEach((to, from, next) => {
  // from.matched.length means it's not the initial load
  console.log('beforeEach', to, from);
  if(from.matched.length) {
    store.dispatch('fetchData', to);
  }
  next();
});

// router.beforeResolve((to, from, next) => {
//   console.log('beforeResolve', to, from);
//   store.dispatch('release', to);
//   next();
// });

export default router;
