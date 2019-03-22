<template>
  <div v-if="title">
    <h1 v-text="title" />
    <div v-if="post && post.description" v-html="post.description" />
    <div v-if="post && post.content" v-html="post.content.rendered" />
    <div v-if="archive.posts">
      <button v-if="prev" @click="prepend()">Load Previous Page</button>
      <div v-for="post in archive.posts">
        <img v-if="post.featured_image"
          :src="post.featured_image.medium.url"
          :width="post.featured_image.medium.width"
          :height="post.featured_image.medium.height" />
        <h2 v-text="post.title.rendered" />
        <div v-html="post.excerpt.rendered" />
        <router-link :to="convertLink(post.link)">View Post</router-link>
      </div>
      <button v-if="next" @click="append()">Load Next Page</button>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions, mapMutations } from 'vuex';

export default {
  name: 'Archive',
  data() {
    return {
      pages: [Number(this.$route.params.page) || 1]
    };
  },
  computed: {
    ...mapState([
     'post', 'archive', 'rest_routes', 'baseURL'
   ]),
   title() {
     if (this.post && this.post.name) {
       return this.post && this.post.name
     }

     if (this.post && this.post.title) {
       return this.post && this.post.title.rendered
     }

     return 'Archive';
   },
   prev() {
     return !(this.pages.indexOf(1) + 1) ? this.archive.page - 1 : false;
   },
   next() {
     return  !(this.pages.indexOf(this.archive.totalpages) + 1) ? Math.max(...this.pages) + 1 : false;
   }
  },
  beforeDestroy() {
    // empty the archive
    // this.$store.commit('archiveReplace', []);
  },
  methods: {
    ...mapActions([
      'fetchArchive'
    ]),
    ...mapMutations([
      'archivePrepend',
      'archiveAppend'
    ]),
    async prepend() {
      // fetch prev page
      const archive = await this.fetchArchive({route: this.$route, page: this.prev});
      this.pages.push(this.prev);
      this.archivePrepend(archive.posts);
      // update window
    },
    async append() {
      // fetch next page
      const archive = await this.fetchArchive({route: this.$route, page: this.next});
      this.pages.push(this.next);
      this.archiveAppend(archive.posts);
      // update window
    },
    convertLink (link) {
      return link.replace(this.baseURL,'');
    },
    updateWindow (page) {
      let vm = this;
      let url = vm.$route.path;

      if ((page < 2) && (url.indexOf("page/") >= 0)) {
        url = url.replace(/\/page\/(\d+)\//g,'');
      } else if(url.indexOf("page/") >= 0) {
        url = url.replace(/\/page\/(\d+)\//g,'/page/' + page + '/');
      } else {
        url += '/page/' + page + '/';
      }

      window.history.pushState(page,'',url);

      // TODO: ScrollTo New Section
    },
  },
}
</script>

<style lang="scss">

</style>
