<template>
  <article class="content">
    <h1>Errors</h1>
    <div>Encountered an error</div>
  </article>
</template>

<script>
import { mapState } from 'vuex';
export default {
  name: 'Error',
  computed: {
    ...mapState([
     'post'
    ])
  }
}
</script>

<style lang="scss">

</style>
