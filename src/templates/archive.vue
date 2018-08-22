<template>
  <div>
    <h1 v-text="title"></h1>
    <div v-if="data.content" v-html="data.content.rendered"></div>
    <div v-if="archive">
      <div v-for="post in archive">
        <img v-if="post.featured_image" :src="post.featured_image.medium.url" :width="post.featured_image.medium.width" :height="post.featured_image.medium.height" />
        <h2 v-text="post.title.rendered"></h2>
        <div v-html="post.excerpt.rendered"></div>
        <router-link :to="convertLink(post.link)" v-on:click.native="updatePost(post)">View Post</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Archive',
  props: ['data'],
  created: function () {
    const vm = this;

    // TODO: Get Archive if no archive

    vm.$http.get( '/wp-json/wp/v2/posts', {
			params: {
        [vm.data.rest_base]: vm.data.id, // this is ignored on index/blog page
        page: vm.$route.params.page
      }
		} )
    .then( ( res ) => {
      this.$store.commit('updateArchive', res.data);
    } )
    .catch( ( res ) => {
      console.log( `Something went wrong : ${res}` );
    } );

  },
  data() {
		return {
      title: this.data.name || this.data.title.rendered || 'Archive',
		};
	},
  computed: {
    archive () {
      return this.$store.state.archive || false
    }
  },
  methods: {
    updatePost (post) {
      this.$store.commit('updatePost', post);
    },
    convertLink (url) {
      return url.replace(site.baseURL,'');
    }
  },
  beforeDestroy() {
    // empty the archive
    // this.$store.commit('updateArchive', false);
  }
}
</script>

<style lang="scss">

</style>
