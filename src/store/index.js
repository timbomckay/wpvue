import Vue from 'vue';
import Vuex from 'vuex';
import mutations from './mutations';
// import actions from './actions';

Vue.use(Vuex);

const state = {
  query: site.query || false
}

const getters = {

}

console.log('mutations', mutations);

const store = new Vuex.Store({
  state: state,
  mutations: mutations,
  // actions: actions,
  // getters: getters,
  // plugins: []
});

export default store;
