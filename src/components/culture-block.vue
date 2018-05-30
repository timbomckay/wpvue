<template>



</template>

<script>

export default {
  name: 'CultureBlock',
  components: {
    
  },
  props: {
    type: {
      type: String,
      default: 'image__caption'
    },
    slides: {
      type: Array,
      required: true
    }
  },
  mounted () {
  }
}
</script>

<style lang="less">
  @import "../utils/variables.less";
  @import "../utils/breakpoints.less";
 
</style>
