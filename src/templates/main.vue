<template>
  <transition appear name="slide-fade" mode="out-in">
    <router-view v-bind:key="key" :data="data"></router-view>
  </transition>
</template>

<script>
export default {
  name: 'Main',
  data() {
		return {
			data: false,
      key: 0 // used for triggering transitions
		};
	},
  watch: {
    // call again the method if the route changes
    '$route': 'fetchData'
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
				vm.data = res.data[0];
        vm.data.type = type;
        vm.key++; // increment key to trigger transition
			} )
			.catch( ( res ) => {
				//console.log( `Something went wrong : ${res}` );
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
