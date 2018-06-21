<template>
  <section class="hero__wrap">
    <div class="container">
      <div class="pre-hero">
        <h1 class="pre-hero__headline">{{ content.headline }}</h1>
        <span class="pre-hero__content">{{ content.subhead }}</span>
      </div>
      <div class="hero" :class="classList" :style="{ 'background-color': 'red' }">
        <div v-if="type == 'caseStudy'" class="hero__next-section">
          <a href="#">
            <icon :href="'chevron-double-down'"></icon>
          </a>
        </div>
      </div>
    </div>
</section>
</template>

<script>
export default {
  name: 'Hero',
  props: {
    type: {
      type: String,
      default: ''
    },
    content: {
      type: Object,
      required: true
    }
  },
  computed: {
    classList: function () {
      let classes = []

      // check for hero type
      if(this.type) {
        classes.push('hero--' + this.type);
      }

      return classes
    }
  }
}
</script>

<style lang="scss">

</style>
