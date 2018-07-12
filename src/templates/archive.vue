<template>
  <transition name="slide-fade" mode="out-in">
    <div>
      <h1 v-text="title"></h1>
      <div v-if="data.content" v-html="data.content.rendered"></div>
      <div v-if="archive">
        <div v-for="post in archive">
          <h2 v-text="post.title.rendered"></h2>
          <div v-html="post.excerpt.rendered"></div>
          <router-link :to="convertLink(post.link)">View Post</router-link>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'Archive',
  props: ['data'],
  created: function () {
    const vm = this;

    vm.$http.get( '/wp-json/wp/v2/posts', {
			params: {
        [vm.data.type]: vm.data.id, // this is ignored on index/blog page
        per_page: 12,
        page: vm.$route.params.page
      }
		} )
    .then( ( res ) => {
      vm.archive = res.data;
    } )
    .catch( ( res ) => {
      //console.log( `Something went wrong : ${res}` );
    } );

  },
  data() {
		return {
      title: this.data.name || this.data.title.rendered || 'Archive',
      archive: false
		};
	},
  methods: {
    // fetchData () {
    //   const vm = this;
    // },
    convertLink (url) {
      return url.replace(site.baseURL,'');
    }
  }
}
</script>

<style lang="scss">

</style>
