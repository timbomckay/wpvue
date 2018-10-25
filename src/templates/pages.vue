<template>
  <article class="content">
    <img v-if="data.featured_image" :src="data.featured_image.full.url" :width="data.featured_image.full.width" :height="data.featured_image.full.height" />
    <h1>{{ data.title.rendered }}</h1>
    <div v-html="data.content.rendered"></div>
  </article>
</template>

<script>
export default {
  name: 'Pages',
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
	}
}
</script>

<style lang="scss">

</style>
