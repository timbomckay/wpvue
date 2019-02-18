<template>
  <div>
    <div>Home</div>
    <div v-if="post.content" v-html="post.content.rendered"></div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
  name: 'Front-Page',
  computed: {
    ...mapState([
     'post'
    ])
  }
}
</script>

<style lang="scss">

</style>
