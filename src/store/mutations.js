/*======================================
| Vuex Mutation Catalog
========================================

exampleMutation:
  Params:
    example(string)
    example2(object)
  Description:
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut

*/

const mutations = {
  postMerge (state, data) {
    state.post = Object.assign(state.post, data);
  },
  postReplace (state, data) {
    state.post = data;
  },
  archiveReplace (state, data) {
    state.archive = data;
  },
  archiveAppend (state, data) {
    state.archive = state.archive.concat(data);
  },
  archivePrepend (state, data) {
    state.archive = data.concat(state.archive);
  }
}

export default mutations;
