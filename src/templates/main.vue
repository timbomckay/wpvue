<template>
  <transition name="slide-fade" mode="out-in">
    <router-view :data="data"></router-view>
  </transition>
</template>

<script>
export default {
  name: 'Main',
  data() {
		return {
			data: false
		};
	},
  watch: {
    // call again the method if the route changes
    '$route': 'fetchData'
  },
  methods: {
    fetchData () {
      const vm = this;
      const type = this.$route.matched[0].components.default.name.toLowerCase();

			vm.$http.get( '/wp-json/wp/v2/' + type, {
				params: {
          slug: vm.$route.params.slug
        }
			} )
			.then( ( res ) => {
				vm.data = res.data[0];
				// vm.loaded = 'true';
				// vm.pageTitle = vm.post.title.rendered;
				// vm.$store.commit( 'rtChangeTitle', vm.pageTitle );
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
