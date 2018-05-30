<template>
  <div v-if="people.length > 3" class="nav-wrapper">
    <div class="swiper-container carousel--card">
    <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
          <!-- Slides -->

          <!-- Image Carousel -->
            <div class="swiper-slide" v-for="(person, key) in people" :key="key">
              <a class="card" :href="person.page_link.link">
                <div class="image-wrap">
                  <img :src="person.image.url" />
                </div>
                <div class="card__content" :class="person.hover_color">
                  <h3 v-text="person.name"></h3>
                  <h5 v-text="person.title"></h5>
                  <a class="cta" :href="person.page_link.link" v-text="person.cta_text"></a>
                </div>
              </a>
            </div>

      </div>

      <!-- If we need scrollbar -->
      <!-- <div class="swiper-scrollbar"></div> -->
    </div>
    <!-- If we need pagination -->
    <ul class="swiper-pagination"></ul>
    
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"><icon href="chevron-left" class="prev"></icon></div>
    <div class="swiper-button-next"><icon href="chevron-right"></icon></div>
  </div>
	<a v-else class="card" :href="people.page_link.link">
    <div class="image-wrap">
      <img :src="people.image.url" />
    </div>
		<div class="card__content" :class="people.hover_color">
      <h3 v-text="people.name"></h3>
      <h5 v-text="people.title"></h5>
      <a class="cta" :href="people.page_link.link" v-text="people.cta_text"></a>
    </div>
	</a>
</template>

<script>
import Swiper from 'swiper'

export default {
  name: 'Card',
  props: {
    type: {
      type: String,
      default: 'team'
    },
    people: {
      type: [Array, Object],
      required: true
    }
  },
  data() {
    return {

    }
  },
  mounted () {
    console.log('this.el: ', this.$el)
    new Swiper('.swiper-container', { // eslint-disable-line no-new
      direction: 'horizontal',
      slidesPerView: 3,
      spaceBetween:  16,
      watchOverflow: true,
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
      loop: true,
      breakpoints: {
        // when window width is <= 480px
        480: {
          slidesPerView: 1,
          spaceBetween: 16,
        },
        // when window width is <= 640px
        768: {
          slidesPerView: 2,
          spaceBetween: 16,
          loop: true,
          navigation: false
        }
      }
      // autoHeight: true
      // parallax: true
    })
  }
}
</script>

<style lang="less">
@import "../utils/variables.less";
@import "../utils/mixins.less";
@import "../utils/breakpoints.less";
  .card{
    max-height: 401px;
    height: auto;
    width: 100%;
    max-width: 300px;
    position: relative;
    // margin: 1rem;
    display: inline-flex;
    .transition;
    @media @small{
      width: auto;
    }
    .image-wrap{
      height: 100%;
      width: 100%;
      position: relative;
      overflow: hidden;
      img {
        height: 100%;
        width: 100%;
        position: relative;
        display: block;
        min-height: 100%;
        max-width: 100%;
        transform: scale(1.06);
        .transition;
      }
    }
    &:hover{
      transform: scale(1.06);
      // -webkit-box-shadow: 2px 9px 50px -12px rgba(0,0,0,0.26);
      // -moz-box-shadow: 2px 9px 50px -12px rgba(0,0,0,0.26);
      // box-shadow: 2px 9px 50px -12px rgba(0,0,0,0.26);

      // -webkit-box-shadow: -2px 8px 52px -7px rgba(0,0,0,0.66);
      // -moz-box-shadow: -2px 8px 52px -7px rgba(0,0,0,0.66);
      // box-shadow: -2px 8px 52px -7px rgba(0,0,0,0.66);

      -webkit-box-shadow: -12px 8px 38px -7px rgba(0,0,0,0.66);
      -moz-box-shadow: -12px 8px 38px -7px rgba(0,0,0,0.66);
      box-shadow: -12px 8px 38px -7px rgba(0,0,0,0.66);
      .image-wrap{
        img{
          transform: scale(1);
        }
      }
      .card__content.lightbulb{
        -webkit-box-shadow: -10px 10px 0px 0px @color-lightbulb;
        -moz-box-shadow: -10px 10px 0px 0px @color-lightbulb;
        box-shadow: -10px 10px 0px 0px @color-lightbulb;
        .cta:before{
          background-color: @color-lightbulb;
        }
      }
      .card__content.aqua{
        -webkit-box-shadow: -10px 10px 0px 0px @color-aqua;
        -moz-box-shadow: -10px 10px 0px 0px @color-aqua;
        box-shadow: -10px 10px 0px 0px @color-aqua;
        .cta:before{
          background-color: @color-aqua;
        }
      }
      .card__content{
        height: 136px;
        h3, h5{
          bottom: 0;
        }
        a{
          opacity: 1;
          bottom: 0;
        }
      }
    }
    &__content{
      background-color: #ffffff;
      max-width: 275px;
      height: 100px;
      position: absolute;
      bottom: 27px;
      left: -22px;
      display: flex;
      flex-flow: row wrap;
      align-content: center;
      padding-top: 1.125rem;
      padding-left: 32px;
      padding-bottom: 1.3125rem;
      overflow: hidden;
      .transition;
      h3, h5{
        text-align: left;
        margin: 0;
        -webkit-margin-before:0;
        -webkit-margin-after:0;
        width: 100%;
        position: relative;
        bottom: -1rem;
        color: @color-blackout;
        .transition;
      }
      a{
        position: relative;
        bottom: -75px;
        opacity: 0;
        .transition;
      }
    }
  }
  // .swiper-slide.swiper-slide-duplicate-prev, .swiper-slide.swiper-slide-duplicate {
  //   opacity: 0;
  // }
  // .swiper-slide{
  //   opacity: 0;
  //   .transition;
  //   @media @medium{
  //     opacity: 1;
  //   }
  //   &.swiper-slide-active,
  //   &.swiper-slide-next {
  //     opacity: 1;
  //   }
  // }
  .nav-wrapper{
    position: relative;
    [role='button'], button:hover:not(.btn-disabled), [role='button']:hover:not(.btn-disabled), .btn:hover:not(.btn-disabled), [type='submit']:hover:not(.btn-disabled), button:focus:not(.btn-disabled), [role='button']:focus:not(.btn-disabled), .btn:focus:not(.btn-disabled), [type='submit']:focus:not(.btn-disabled){
      color: @color-cobalt;
    }
    .swiper-button-prev {
      left: -100px;
    }
    .swiper-button-next {
      right: -100px;
    }
    .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets{
      position:relative;
    }
    .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets{
      .swiper-pagination-bullet-active:after{
        background: @color-cobalt;
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
        border: 4px solid @color-cobalt;
      }
    }
  }
  .swiper-container {
    padding-top: 20px !important;
    &.carousel{
      &--card{
        .swiper-slide{
          text-align: center;
          height: 100%;
        }
      }
    }
  }
</style>
