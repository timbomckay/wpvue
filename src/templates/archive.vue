<template>
  <div v-if="title">
    <h1 v-text="title" />
    <div
      v-if="post.content"
      v-html="post.content.rendered" />
    <div v-if="archive.posts">
      <button v-if="prev" @click="fetchArchive({route: $route, dir: 'archivePrepend'})">Load Previous Page</button>
      <div v-for="post in archive.posts">
        <img v-if="post.featured_image"
          :src="post.featured_image.medium.url"
          :width="post.featured_image.medium.width"
          :height="post.featured_image.medium.height" />
        <h2 v-text="post.title.rendered" />
        <div v-html="post.excerpt.rendered" />
        <router-link :to="convertLink(post.link)" @click.native="$store.commit('postReplace', post)">View Post</router-link>
      </div>
      <button v-if="next" @click="fetchArchive({route: $route, dir: 'archiveAppend'})">Load Next Page</button>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
export default {
  name: 'Archive',
  data() {
    return {
      page: {
        prev: this.$route.params.page ? Number(this.$route.params.page) - 1 : 0,
        next: false
      }
    };
  },
  computed: {
    ...mapState([
     'post', 'archive', 'rest_routes', 'baseURL'
   ]),
   title: function () {
     if (this.post.name) {
       return this.post.name
     }

     if (this.post.title) {
       return this.post.title.rendered
     }

     return 'Archive';
   },
   prev() {
     return this.archive.page > 1;
   },
   next() {
     return this.archive.page < this.archive.totalpages;
   }
  },
  created () {
    // initial instance, check for total pages to be more than 1
    if (this.post.pages && (this.post.pages > 1)) {
      if (this.$route.params.page) {
        if (this.$route.params.page === this.post.pages) {
          this.page.next = false
        }
        if (this.$route.params.page < this.post.pages) {
          // if current page is more than 1 and less than total pages
          this.page.next = Number(this.$route.params.page) + 1
        }
      } else {
        // assume we're on the first page
        this.page.next = 2
      }
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
