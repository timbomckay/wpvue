<template>
  <div>
    <h1 v-text="title" />
    <div
      v-if="post.content"
      v-html="post.content.rendered" />
    <div v-if="archive">
      <button
        v-if="page.prev"
        @click="fetchArchive('prev', page.prev)">Load Previous Page</button>
      <div v-for="post in archive">
        <img
          v-if="post.featured_image"
          :src="post.featured_image.medium.url"
          :width="post.featured_image.medium.width"
          :height="post.featured_image.medium.height">
        <h2 v-text="post.title.rendered" />
        <div v-html="post.excerpt.rendered" />
        <router-link
          :to="convertLink(post.link)"
          @click.native="postReplace(post)">View Post</router-link>
      </div>
      <button
        v-if="page.next"
        @click="fetchArchive('next', page.next)">Load More</button>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
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
     return this.post.name || this.post.title.rendered || 'Archive';
   }
  },
  created () {
    if (!this.archive.length) {
      this.fetchArchive();
    }

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
    // this.$store.commit('archiveReplace', false);
  },
  methods: {
    postReplace (post) {
      this.$store.commit('postReplace', post);
    },
    convertLink (url) {
      return url.replace(this.baseURL,'');
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
    fetchArchive (dir, page = (this.$route.params.page || 1)) {
      const vm = this;
      vm.$http.get( '/wp-json/wp/v2/posts', {
        params: {
          [vm.rest_routes['taxonomies'][vm.$route.params.taxonomy]]: vm.post.id, // this is ignored on index/blog page
          page: page
        }
      } )
        .then( ( res ) => {
          const pages = Number(res.headers['x-wp-totalpages']);

          vm.$store.commit('postMerge', {pages: pages});

          switch (dir) {
            case 'prev':
              vm.$store.commit('archivePrepend', res.data);
              vm.page.prev--
              vm.updateWindow(page);
              break;
            case 'next':
              vm.$store.commit('archiveAppend', res.data);
              vm.page.next = (page < pages) ? page + 1 : false
              vm.updateWindow(page);
              break;
            default:
              if (page < pages) {
                vm.page.next = page + 1
              }
              vm.$store.commit('archiveReplace', res.data);
          }

        } )
        .catch( ( res ) => {
          console.log( `Something went wrong : ${res}` );
      } );
    }
  },
}
</script>

<style lang="scss">

</style>
