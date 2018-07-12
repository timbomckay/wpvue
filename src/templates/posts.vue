<template>
  <div>
    <img v-if="data.featured_image" :src="data.featured_image.medium_large.url" :width="data.featured_image.medium_large.width" :height="data.featured_image.medium_large.height" />
    <h1>{{ data.title.rendered }}</h1>
    <div v-html="data.content.rendered"></div>
  </div>
</template>

<script>
export default {
  name: 'Posts',
  props: ['data'],
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
