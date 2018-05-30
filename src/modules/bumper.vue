<template>
  <div v-if="type === 'newsletter'" class="bumper bumper__newsletter">
    <div class="bumper__newsletter--con">
      <h2>Who doesn't love a helpful newsletter?</h2>
      <form class="row align-items-end" id="newsletter">
        <div class="col-9">
          <label for="email">Email</label>
          <input name="email" type="email" placeholder="example@email.com">
        </div>
        <div class="col-3">
          <button class="btn btn-secondary btn-icon" type="submit"><icon href="pointer-right"></icon></button>
        </div>
        <div class="col-12">
          <p class="field-info-text">We send it once a month and never spam.</p>
        </div>
      </form>
    </div>
  </div>
  <div v-else-if="type === 'standard'">
    <div v-for="(bumper, key) in content" :key="key" class="bumper bumper__standard" :style="`background-image: url(${bumper.image})`">
      <div class="bumper__standard--con">
        <h5 v-text="bumper.preheading"></h5>
        <h2 v-text="bumper.title"></h2>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'bumper',
  props: {
    type: {
      type: String,
      default: 'newsletter'
    },
    content: {
      type: Array,
      required: false
    }
  },
  data() {
    return {

    }
  },
  mounted () {
  }
}
</script>

<style lang="less">
@import "../utils/variables.less";
@import "../utils/mixins.less";
@import "../utils/breakpoints.less";
.bumper{
  height: 20.25rem;
  min-width: 21.5625rem;
  display: flex;
  flex-flow: column wrap;
  @media @medium{
    // padding: 5rem 2rem;
    height: 451px;
  }
  &__newsletter{
    background-color: @color-cobalt;
    color: #ffffff;
    justify-content: center;
    align-items: center;
    transform: translate3d(0, 0, 0);
    // padding: 2.1875rem .9375rem;
    .transition;
    @media @medium{
      // padding: 5rem 2rem;
      height: 451px;
    }
    @media @extra-large{
      // padding: 8rem 7rem;
    }
    input{
      text-indent: 7px;
      &::placeholder{
        color: #ffffff;
      }
    }
    &--con {
      max-width: 400px;
    }
    [type='submit']{
      margin: 0;
    }
    .field-info-text{
      padding-top: 5px;
    }
    &:hover{
      transform: translate3d(0, 0, 0) scale(1.06);
      background-image: url('/wp-content/themes/bsm/images/patterns/Confetti-Blue-BG.svg');
    }
  }
  &__standard{
    color: #ffffff;
    &--con {
      max-width: 400px;
      position: relative;
      padding: 26px 35px;
      h2{
        margin-top: 0;
      }
      h5{
        margin-bottom: 0;
      }
    }
    &:before{
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      margin-right: 1rem;
      margin-left: 1rem;
      background-color: rgba(36,36,36,0.25);
      box-shadow: 0 0 4px 0 rgba(16,6,56,0.6);
    }
  }
}
</style>
