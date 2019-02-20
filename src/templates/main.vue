<template>
  <transition appear name="slide-fade" mode="out-in">
    <errors v-if="error"></errors>
    <router-view v-else v-bind:key="transition"></router-view>
  </transition>
</template>

<script>
import { mapState, mapActions } from 'vuex';
export default {
  name: 'Main',
  components: {
    'errors': () => import(/* webpackChunkName: "errors" */'./errors.vue')
  },
  data() {
		return {
      transition: 0, // used for triggering transitions
      error: !(this.$store.state.post || this.$store.state.archive) // TODO: Switch error to state with store mutation
		};
	},
  watch: {
    '$route' (to, from) {
      // fetchPost if the route changes
      // from.matched.length means it's not the initial load
      if(from.matched.length) {
        this.fetchData(to);
      }

      // increment transition to trigger transition
      this.transition++;
    }
  },
  computed: {
    ...mapState([
     'post'
    ])
  },
  methods: {
    ...mapActions([
      'fetchData'
    ])
  }
}
</script>

<style lang="scss">
  /* Enter and leave animations can use different */
  /* durations and timing functions.              */
  .slide-fade-enter-active,
  .slide-fade-leave-active {
    transition: all 0.2s ease-in-out;
  }
  .slide-fade-enter, .slide-fade-leave-to {
    opacity: 0;
  }
  .slide-fade-enter, .slide-fade-leave-to {
    transform: translateY(10px);
  }
</style>
