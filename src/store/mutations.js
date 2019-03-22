/*======================================
| Vuex Mutation Catalog
======================================*/

export default {
  postMerge (state, data) {
    state.post = Object.assign(state.post, data);
  },
  postReplace (state, data) {
    // if (data.id === state.post.id) {
    //   state.post = Object.assign(state.post, data);
    // } else {
    //   state.post = data;
    // }
    // TODO: fix New Tab click
    state.post = data;
  },
  archiveReset (state) {
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
