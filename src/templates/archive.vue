<template>
  <transition name="slide-fade" mode="out-in">
    <div>Archive</div>
  </transition>
</template>

<script>
export default {
  name: 'Archive',
  props: ['data'],
  data() {
		return {

		};
	},
  // watch: {
  //   '$route': 'fetchData'
  // },
  methods: {
    fetchData () {
      const vm = this;
    }
  }
}
</script>

<style lang="scss">

</style>
