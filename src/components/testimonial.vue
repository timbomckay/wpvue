<template>
  <div class="testimonial">
    <p class="test-quote" v-text="content.quote"></p>
    <h6>{{content.name}} | {{content.title}}</h6>
    <icon href="quote"></icon>
  </div>
</template>

<script>
export default {
  name: 'Testimonial',
  props: {
    content: {
      type: Object,
      required: true
    }
  }
}
</script>

<style lang="less">
@import "../utils/variables.less";
@import "../utils/mixins.less";
@import "../utils/breakpoints.less";
  .testimonial{
    background-color: @color-cobalt;
    display: flex;
    flex-flow: column wrap;
    padding: 3rem 1rem 3rem 1.875rem;
    justify-content: flex-start;
   
    @media @extra-large{
      padding: 6.3125rem 6.75rem;
    }
    &.col, 
    &.col-12, 
    &.col-sm-12, 
    &.col-md-12, 
    &.col-lg-12, 
    &.col-xl-12 {
      @media @small {
        justify-content: center;
        align-items: center;
        text-align: center;
        .test-quote{
          max-width: 37rem;
          margin-bottom: .9375rem;
        }
      }
    }
    .test-quote, h6{
      color: #ffffff;
      z-index: 2;
      margin: 0;
    }
    h6{
      font-weight: 400;
    }
    .icon{
      fill: @color-cobalt-lighter;
      height: 13.25rem;
      width: 13.25rem;
      position: absolute;
      z-index: 1;
      left: 1%;
      top: 0rem;
      @media @small{
        left: 8%;
        top: 2rem;
      }
    }
  }
</style>
