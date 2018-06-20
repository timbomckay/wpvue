<template>
    <div v-if="slides.length > 1" class="swiper-container" :class="`carousel--${type}`">
    <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
          <!-- Slides -->

          <!-- Image Carousel -->
          <div v-if="type === 'image__caption' || type === 'image__no-caption'" class="swiper-slide" v-for="(slide, key) in slides" :key="key" :style="{ 'background-image': 'url(' + slide.image.url + ')' }">
            <h6 v-if="type === 'image__caption'" class="swiper-slide__caption">{{slide.image.caption.rendered}}</h6>
          </div>

          <!-- Process Carousel (used only once?) -->
          <div v-if="type === 'process'" class="swiper-slide" v-for="(slide, key) in slides" :key="key">
            <h2 class="bold" v-text="slide.title"></h2>
            <h5 v-text="slide.content"></h5>
          </div>
      </div>
      <!-- If we need pagination -->
      <ul class="swiper-pagination"></ul>

      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev"><icon href="chevron-left" class="prev"></icon></div>
      <div class="swiper-button-next"><icon href="chevron-right"></icon></div>

      <!-- If we need scrollbar -->
      <!-- <div class="swiper-scrollbar"></div> -->
    </div>
    <div v-else class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide" v-for="(slide, key) in slides" :key="key" :style="{ 'background-image': 'url(' + slide.image.url + ')' }">
          <h6 v-if="type === 'image__caption'" class="swiper-slide__caption">{{slide.image.caption.rendered}}</h6>
        </div>
      </div>
    </div>
</template>

<script>
import Swiper from 'swiper'
import card from '../modules/cards.vue'

export default {
  name: 'Carousel',
  components: {
    card
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
    console.log('this.el: ', this.$el)
    if (this.type === 'card') {
      new Swiper(this.$el, { // eslint-disable-line no-new
        direction: 'horizontal',
        slidesPerView: 3,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true,
          bulletElement: 'li'
        },
        loop: true
        // autoHeight: true
        // parallax: true
      })
    } else if (this.type === 'process') {
      new Swiper(this.$el, { // eslint-disable-line no-new
        direction: 'horizontal',
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true,
          // bulletElement: 'li',
          renderBullet: function (index, className) {
            return '<li class="' + className + '">' + '<span class="bar"></span>' + '</li>';
          }
        },
        loop: true
        // autoHeight: true
        // parallax: true
      })
    } else {
      new Swiper(this.$el, { // eslint-disable-line no-new
        direction: 'horizontal',
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true,
          bulletElement: 'li'
        },
        loop: true
        // autoHeight: true
        // parallax: true
      })
    }
  }
}
</script>

<style lang="scss">
  @import "../utils/variables.less";
  @import "../utils/breakpoints.less";
  .swiper-container {
    min-height: 23.43rem;
    width: 100%;
    position: relative;
    overflow: hidden;
    list-style: none;
    padding: 0;
    z-index: 1;
    &.carousel{
      &--image{
        &__caption{
          .swiper-slide__caption{
            display: none;
            @media @small{  
              display: block;
            }
          }
        }
        &__no-caption{
        }
      }
      &--card{
        .swiper-slide{
          text-align: center;
          height: 100%;
        }
        [role='button']{
          color: $color-primary;
        }
        .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets{
          position:relative;
        }
        .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets{
          .swiper-pagination-bullet-active:after{
            background: $color-primary;
          }
          // & li{
          //   display: inline-flex;
          //   justify-content: center;
          //   align-items: center;
          //   padding: 0;
          //  .bar{
          //     width: 50px;
          //     height: 2px;
          //     background-color: #ebebeb;
          //     margin: 0 15px;
          //   }
          //   &:first-child{
          //     .bar{
          //       display: none;
          //     }
          //   }
          // }
          & li:after {
            border: 4px solid $color-primary;
          }
        }
      }
      &--process{
        [role='button']{
          color: $color-primary;
        }
        .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets{
          .swiper-pagination-bullet-active:after{
            background: $color-primary;
          }
          & li{
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 0;
           .bar{
              width: 50px;
              height: 2px;
              background-color: #ebebeb;
              margin: 0 15px;
            }
            &:first-child{
              .bar{
                display: none;
              }
            }
          }
          & li:after {
            border: 4px solid $color-primary;
          }
        }
      }
    }
  }
  .swiper-container-android .swiper-slide, .swiper-wrapper {
    -webkit-transform: translate3d(0,0,0);
    transform: translate3d(0,0,0);
  }
  .swiper-wrapper {
      position: relative;
      width: 100%;
      height: 100%;
      z-index: 1;
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      -webkit-transition-property: -webkit-transform;
      transition-property: -webkit-transform;
      -o-transition-property: transform;
      transition-property: transform;
      transition-property: transform,-webkit-transform;
      -webkit-box-sizing: content-box;
      box-sizing: content-box;
  }
  .swiper-slide {
    -webkit-flex-shrink: 0;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    width: 100%;
    // height: 100%;
    position: relative;
    -webkit-transition-property: -webkit-transform;
    transition-property: -webkit-transform;
    -o-transition-property: transform;
    transition-property: transform;
    transition-property: transform,-webkit-transform;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    width: 100%;
    height: 23.43rem;
    position: relative;
    transition-property: transform;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    &__caption{
      font-family: @pt-sans;
      font: 600 1rem/1.18 @pt-sans;
      color: white;
      letter-spacing: .5px;
      text-align: center;
      text-align: center;
      position: absolute;
      bottom: 3rem;
      width: 100%;
      text-transform: capitalize;
    }
  }
  .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets, 
  .swiper-button-prev, .swiper-button-next {
    position: relative;
  }
  .swiper-button-next, .swiper-button-prev {
    background-color: transparent !important;
    box-shadow: none !important;
    position: absolute;
    top: 50%;
    margin-top: -22px;
    z-index: 10;
    padding: 0;
    & svg.icon{
      height:2.18rem;
      width:2.18rem;
    }
  }
  .swiper-button-next, .swiper-container-rtl .swiper-button-prev {
    background-image: none;
    right: 10px;
    left: auto;
  }
  .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets {
    // position: relative;
    // z-index: 1;
    // bottom: 0;
    // display: flex;
    // justify-content: center;
    // -webkit-padding-start: 0;
    // bottom: 25%;
    z-index: 1;
    position: absolute;
    bottom: 0;
    width: 100%;
    text-align: center;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    -webkit-padding-start: 0px;
    .swiper-pagination-bullet{
      background-color: transparent !important;
      box-shadow: none !important;
    }
    .swiper-pagination-bullet-active:after{
      background: #fff;
    }
    & li{
      margin: 0;
      padding: 0 .5rem;
      &:after {
        content: '';
        height: .875rem;
        width: .875rem;
        display: block;
        position: relative;
        transform: rotate(45deg);
        // top: .25em;
        left: 0;
        border: 4px solid #fff;
      }
    }

  }
</style>
