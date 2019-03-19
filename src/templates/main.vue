<template>
  <errors v-if="error" />
  <router-view v-else />
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'Main',
  components: {
    'errors': () => import(/* webpackChunkName: "errors" */'./errors.vue')
  },
  data() {
		return {
      error: !(this.$store.state.post || this.$store.state.archive) // TODO: Switch error to state with store mutation
		};
	},
  computed: {
    ...mapState([
     'post'
    ])
  }
}
</script>
