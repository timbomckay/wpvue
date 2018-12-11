import axios from 'axios';

/*======================================
| Vuex Action Catalog
========================================

exampleAction:
  Params:
    example(string)
    example2(object)
  Description:
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut

*/

// TODO: Update 'edit post' link with new id

const actions = {
  updateTitle ({state}) {
    const title = state.post.title ? state.post.title.rendered : false;
    document.title = title ? `${title} | ${site.name}` : site.name;
  },
  fetchData ({ dispatch, commit, state }, route) {
    // console.log('route:meta', route.meta);
    // console.log('route:params', route.params);
    // console.log('state:rest_routes', state.rest_routes);
    const SINGLE = route.meta.route || '';

    if (SINGLE) {
      const ID = route.params.id || route.meta.id || '';
      const SLUG = route.params.slug || route.meta.slug || '';

      let params = {};

      if(!ID && SLUG) {
        params.slug = SLUG
      }

      axios.get( `/wp-json/wp/v2/${SINGLE}/${ID}`, {
        params: params
      } )
      .then( ( res ) => {
        commit('postReplace', res.data.length ? res.data[0] : res.data);
        dispatch('updateTitle');
      } )
      .catch( ( res ) => {
        console.log( `Something went wrong : ${res}` );
      } );
    }

    const ARCHIVE = route.meta.archive || false;
    
    if (ARCHIVE) {
      axios.get( `/wp-json/wp/v2/${ARCHIVE}`, {
        params: {}
      } )
      .then( ( res ) => {
        // send to state.archive
        console.log('archive:success', res.data);
      } )
      .catch( ( res ) => {
        console.log( `Something went wrong : ${res}` );
      } );
    }

    // updateTitle after both/either are finished
  }
}

export default actions;
