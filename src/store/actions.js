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

    if (state.archive.posts.length) {
      commit('archiveReset');
    }

    if (route.meta.route) {
      await dispatch('fetchPost', route);
    }

    if (route.meta.archive) {
      dispatch('fetchArchive', route);
    }

    // updateTitle after both/either are finished
  },
  async fetchPost({ dispatch, commit, state }, route) {
    console.log('fetchPost');
    let params = {};

    const SLUG = route.params.slug || route.meta.slug;
    if (SLUG) {
      params.slug = SLUG;
    }

    if (!route.meta.archive && route.params.page) {
      params.page = route.params.page;
    }

    await axios.get(`/wp-json/wp/v2/${route.meta.route}`, {
      params: params
    })
    .then((res) => {
      let post = res.data;

      // if response is array
      if (res.data.length) {
        // get item with link matching route
        post = res.data.filter(x => x.link === (state.baseURL + route.path))[0];
      }

      commit('postReplace', post);
      dispatch('updateTitle');
    })
    .catch( ( res ) => {
      console.log( `Error with fetchPost : ${res}` );
    });
  },
  fetchArchive({ dispatch, commit, state }, data) {
    console.log('fetchArchive');
    const ID = state.post.id;
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

    if (route.meta.route === 'users') {
      params.authors = ID;
    } else {
      params[route.meta.route] = ID;
    }

    axios.get( `/wp-json/wp/v2/${route.meta.archive}`, {
      params: params
    } )
    .then( ( res ) => {
      const total = Number(res.headers['x-wp-total']);
      const totalpages = Number(res.headers['x-wp-totalpages']);

      if(data.dir) {
        commit(data.dir, res.data);
      } else {
        // send to state.archive
        commit('archiveReplace', {
          posts: res.data,
          page: Number(route.params.page) || 1,
          total: total,
          totalpages: totalpages
        });
      }
    } )
    .catch( ( res ) => {
      console.log( `Error with fetchArchive : ${res}` );
    } );
  },
};
