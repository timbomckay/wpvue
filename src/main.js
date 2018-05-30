import './main.less';
import Vue from 'vue';
// import Router from './router.js';
import Main from './templates/main.vue';

/* ======== Register all .vue components in the provided context ==========|
| Uncomment below when the proper context/naming-convention is determined. |
===========================================================================|
  const requireComponent = require.context('./components', true, /.vue$/);
  requireComponent.keys().forEach(componentPath => {
    const componentConfig = requireComponent(componentPath);
    const fileName = componentPath.split('/')[componentPath.split('/').length - 1];
    const kebabName = fileName.split('.')[0].split('-');
    let componentName = '';
    for (var i = 0; i < kebabName.length; i++) {
      componentName += `${kebabName[i].charAt(0).toUpperCase()}${kebabName[i].slice(1,kebabName[i].length)}`;
    }
    Vue.component(componentName, componentConfig.default || componentConfig);
  })
*/

import icon from './elements/icon.vue'

Vue.component('icon', icon)

new Vue({
  el: '#main',
  render: (h) => h(Main),
});
