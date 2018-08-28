<template>
  <transition appear name="slide-fade" mode="out-in">
    <router-view v-bind:key="key" :data="post"></router-view>
  </transition>
</template>

<script>
export default {
  name: 'Main',
  data() {
		return {
      key: 0 // used for triggering transitions
		};
	},
  watch: {
    '$route' (to, from) {
      // fetchData if the route changes
      // from.matched.length means it's not the initial load
      if(from.matched.length && (to.params.slug !== this.post.slug)) {
        this.fetchData();
        this.$store.commit('updateArchive', false);
      }
      this.key++; // increment key to trigger transition
      window.scrollTo(0, 0); // scroll back to top
      // TODO Update page title
    }
  },
  computed: {
    post () {
      return this.$store.state.post
    }
  },
  methods: {
    fetchData () {
      const vm = this;
      // assign component name as default posttype
      let type = vm.$route.matched[0].components.default.name.toLowerCase();
      // assign default parameters
      let params = {
        slug: vm.$route.params.slug || false
      }

      // TODO: Remove this in favor of new site.rest_routes
      function checkPostType (name) {

        const names = {
          'front-page': function () {
            type = 'pages';
            params.slug = site.home
          },
          'category': function () {
            type = 'categories';
          },
          'tag': function () {
            type = 'tags';
          },
          'archive': function () {

            if(!params.slug) {
              type = 'pages'
              params.slug = site.blog
            } else {
              names[vm.$route.params.taxonomy]();
            }

          }
        };

        // run function if name is listed
        if(names[name]) {
          names[name]();
        }

        return type;
      }

			vm.$http.get( '/wp-json/wp/v2/' + checkPostType(type), {
				params: params
			} )
			.then( ( res ) => {
        vm.$store.commit('updatePost', Object.assign(res.data[0], {type: type}));
			} )
			.catch( ( res ) => {
				console.log( `Something went wrong : ${res}` );
			} );
    }
  }
}
</script>

<style lang="scss">
  /* Enter and leave animations can use different */
  /* durations and timing functions.              */
  .slide-fade-enter-active,
  .slide-fade-leave-active {
    transition: all 0.2s ease-in-out;
  }
  .slide-fade-enter, .slide-fade-leave-to {
    opacity: 0;
  }
  .slide-fade-enter, .slide-fade-leave-to {
    transform: translateY(10px);
  }
</style>
