<template>
  <transition name="slide-fade" mode="out-in">
    <div>Home</div>
  </transition>
</template>

<script>
export default {
  name: 'Front-Page',
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
