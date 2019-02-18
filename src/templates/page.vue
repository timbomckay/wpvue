<template>
  <article v-if="post.title" class="content">
    <img v-if="post.featured_image" :src="post.featured_image.full.url" :width="post.featured_image.full.width" :height="post.featured_image.full.height" />
    <h1>{{ post.title.rendered }}</h1>
    <div v-html="post.content.rendered"></div>
  </article>
</template>

<script>
import { mapState } from 'vuex';
export default {
  name: 'Page',
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
