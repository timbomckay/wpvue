<template>
  <div>
    <img v-if="data.featured_image" :src="data.featured_image.full.url" :width="data.featured_image.full.width" :height="data.featured_image.full.height" />
    <h1>{{ data.title.rendered }}</h1>
    <div v-html="data.content.rendered"></div>
  </div>
</template>

<script>
export default {
  name: 'Pages',
  props: ['data'],
  data() {
		return {

		};
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
