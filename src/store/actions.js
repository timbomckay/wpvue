import axios from 'axios';

/*======================================
| Vuex Action Catalog
======================================*/

// TODO: Update 'edit post' link with new id

export default {
  updateTitle ({state}) {
    const title = state.post.title ? state.post.title.rendered : false;
    document.title = title ? `${title} | ${site.name}` : site.name;
  },
  async fetchData ({ dispatch, commit, state }, route) {
    // console.log('fetchData:route', route);
    // console.log('state:rest_routes', state.rest_routes);
    let post = {};
    let archive = {};

    if (route.meta.route) {
      post = await dispatch('fetchPost', route);
    }

    if (route.meta.archive) {
      archive = await dispatch('fetchArchive', {route, post});
    }

    commit('postReplace', post);

    if (archive.posts && archive.posts.length) {
      commit('archiveReplace', archive);
    } else {
      commit('archiveReset');
    }

    dispatch('updateTitle');
  },
  async fetchPost({ dispatch, commit, state }, route) {
    let params = {};

    const SLUG = route.params.slug || route.meta.slug;
    if (SLUG) {
      params.slug = SLUG;
    }

    if (!route.meta.archive && route.params.page) {
      params.page = route.params.page;
    }

    try {
      // fetch data from a url endpoint
      const response = await axios.get(
        `/wp-json/wp/v2/${route.meta.route}`,
        { params: params }
      );

      let post = response.data;

      // if response is array
      if (response.data.length) {
        // get item with link matching route
        post = response.data.filter(x => x.link === (state.baseURL + route.path))[0];
      }

      return post;
    } catch (error) {
      console.log( `Error with fetchPost : ${error}` );
    }
  },
  async fetchArchive({ dispatch, commit, state }, data) {
    const ID = data.post ? data.post.id : state.post.id;
    const route = data.route || data;

    // TODO: Get page param

    const fields = [
      'title',
      'id',
      'link',
      'type',
      'excerpt',
      'featured_image',
      'modified' // used for cache busting
    ];

    let params = {
      '_fields': fields.join()
    };

    if (route.name !== 'blog') {
      if (route.meta.route === 'users') {
        params.authors = ID;
      } else {
        params[route.meta.route] = ID;
      }
    }

    if (data.page) {
      params.page = data.page;
    }

    try {
      // fetch data from a url endpoint
      const response = await axios.get(
        `/wp-json/wp/v2/${route.meta.archive}`,
        { params: params }
      );

      return {
        posts: response.data,
        page: Number(route.params.page) || 1,
        total: Number(response.headers['x-wp-total']),
        totalpages: Number(response.headers['x-wp-totalpages'])
      };

      // if(data.dir) {
      //   commit(data.dir, response.data);
      // }
    } catch (error) {
      console.log( `Error with fetchArchive : ${error}` );
    }
  },
};
