import Vue from 'vue';
import Vuex from 'vuex';
import { mutations } from './mutations';
import { actions } from './actions';

Vue.use(Vuex);

const state = {
  obj: ''
}

const getters = {
  getObj(state) { return state.obj }
}

const store = new Vuex.Store({
  state: state,
  mutations: mutations,
  actions: actions,
  getters: getters,
  plugins: []
});

export default store;
