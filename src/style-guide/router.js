import Vue from 'vue';
import VueRouter from 'vue-router';

let routes = [];

const requireComponent = require.context('.', true, /.vue$/);
console.log(requireComponent);
requireComponent.keys().forEach(componentPath => {
  const componentConfig = requireComponent(componentPath);
  console.log(componentPath);
  const fileName = componentPath.split('/')[componentPath.split('/').length - 1];
  const kebabName = fileName.split('.')[0];
  routes.push({
    path: `/style-guide/${kebabName}`,
    component: componentConfig.default || componentConfig,
    name: kebabName
  })
})

console.log(routes);
Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  linkActiveClass: 'active', // a css class indicating route anchor active state
  routes: routes
});

export default router;
