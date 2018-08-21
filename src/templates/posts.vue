<template>
  <article class="content">
    <img v-if="data.featured_image" :src="data.featured_image.medium_large.url" :width="data.featured_image.medium_large.width" :height="data.featured_image.medium_large.height" />
    <h1>{{ data.title.rendered }}</h1>
    <div v-html="data.content.rendered"></div>
  </article>
</template>

<script>
export default {
  name: 'Posts',
  props: ['data'],
  mounted: function () {
    let vm = this;
    document.querySelectorAll(".content a").forEach(function(link) {
      link.addEventListener("click", function(event) {
        if(link.origin === site.baseURL) {
          event.preventDefault();
          vm.$router.push({ path: link.href.replace(site.baseURL,'')});
        }
      }, false);
    });
  },
  data() {
		return {

		};
	},
  watch: {
    // call again the method if the route changes
    // '$route': 'fetchData'
  },
  methods: {
    fetchData () {
      const vm = this;
    }
  }
}
</script>

<style lang="scss">

</style>
