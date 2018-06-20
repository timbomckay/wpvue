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
@import "../utils/variables.less";
@import "../utils/mixins.less";
@import "../utils/breakpoints.less";
  .hero {
    height: 375px;
    width: 100%;
    background-repeat: no-repeat;
    background-size: cover;
    text-align: center;
    color: #fff;
    box-shadow: -1.625rem -1.625rem 0px 0px $color-primary-lighter;
    h2 { margin: 2em auto }
    &__wrap {
      background-color: white;
      padding: 4.0625rem 0;
    }
    &--home {
      width: 50%;
      background-color: red;
    }
    &__next-section {
      padding-top: 3.125rem;
      a {
        display: inline-block;
        color: white;
        font-size: 2.75rem;
        &:hover, &:active {
          & > svg {
            color: white;
            transform: translate(0px, 10px);
          }
        }
      }
    }
  }
  .pre-hero {
      text-align: center;
      padding: 0 0 6.25rem;
      margin: 0 auto;

      @media @large {
          max-width: 60%;
      }

      &__headline {
          margin-bottom: 0.875rem;
      }

      &__content {
      }
  }
</style>
