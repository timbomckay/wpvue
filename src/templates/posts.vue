<template>
  <div>
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
