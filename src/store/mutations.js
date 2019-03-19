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

export default {
  postMerge (state, data) {
    state.post = Object.assign(state.post, data);
  },
  postReplace (state, data) {
    console.log('postReplace');
    // if (data.id === state.post.id) {
    //   state.post = Object.assign(state.post, data);
    // } else {
    //   state.post = data;
    // }
    // TODO: fix New Tab click
    state.post = data;
  },
  archiveReset (state) {
    console.log('archiveReset');
    state.archive = {
      posts: [],
      page: null,
      total: null,
      totalpages: null
    };
  },
  archiveReplace (state, data) {
    state.archive = data;
  },
  archiveAppend (state, data) {
    state.archive.page += 1;
    state.archive.posts = state.archive.posts.concat(data);
  },
  archivePrepend (state, data) {
    state.archive.page -= 1;
    state.archive.posts = data.concat(state.archive.posts);
  }
};
