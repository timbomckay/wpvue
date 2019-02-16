<template>
  <article class="content">
    <img v-if="post.featured_image" :src="post.featured_image.medium_large.url" :width="post.featured_image.medium_large.width" :height="post.featured_image.medium_large.height" />
    <h1>{{ post.title.rendered }}</h1>
    <div v-html="post.content.rendered"></div>
  </article>
</template>

<script>
import { mapState } from 'vuex';
export default {
  name: 'Post',
  mounted: function () {
    let vm = this;
    document.querySelectorAll(".content a").forEach(function(link) {
      link.addEventListener("click", function(event) {
        if(link.origin === vm.baseURL) {
          event.preventDefault();
          vm.$router.push({ path: link.href.replace(vm.baseURL,'')});
        }
      }, false);
    });
  },
  computed: {
    ...mapState([
     'post', 'baseURL'
    ])
  }
}
</script>

<style lang="scss">

</style>
