<template>
  <nav class="nav">
    <div class="nav__logo">
      <icon :icon='false' :href='"logo"'></icon>
    </div>
    <ul class="nav__links-container">
      <li class="nav__link-container" v-for="(link, index) in links" :key="index">
        <a v-if="!link.drop" class="nav-link" :href="link.href">{{ link.title }}</a>
        <a v-else class="dropdown--up-mobile" tabindex="0" :class="{'dropdown--up-mobile--active': dropOpen}" @click='dropOpen = !dropOpen' v-on:close-toggles='closeNavDD'>
          {{ link.title }}
          <ul v-if="link.drop.length">
            <li v-for="(drop, i) in link.drop" :key="i">
              <a :href="drop.href">{{ drop.title }}</a>
            </li>
          </ul>
        </a>
      </li>
      <li v-if="cta.title" class="nav__cta"><a class="btn" :href="cta.href">{{ cta.title }}</a></li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: 'bsm-nav',
  props: {
    cta: {
      type: Object,
      default: () => {
        return {
          href: '/contact',
          title: 'Contact'
        }
      }
    },
    links: {
      type: Array,
      validator: value => {
        let valid = true;
        for (var i = 0; i < value.length; i++) {
          if (!("title" in value[i]))
            valid = false;
        }
        return valid;
      }
    },
    logo: {
      type: Object
    }
  },
  data() {
    return {
      win: window,
      dropOpen: false
    }
  },
  methods: {
    closeNavDD(e, other) {
      console.log(e);
      console.log(other);
    }
  }
}
</script>

<style lang="less">
@import '../utils/mixins';
@import '../utils/breakpoints';
@import '../utils/variables';
@import '../utils/helper-other';
@import '../elements/links';

  .nav {
    .transition('background-color');
    justify-content: center;

    @media @medium {
      position: fixed;
      top: 0;
      left: 0;
      background-color: #fff;
      z-index: 50;
      // height: 7.5rem;
      height: 5.875rem;
      width: 100%;
      display: flex;
      padding: 0 2.5rem;
    }

    @media @large {
      padding: 0 5rem;
    }

    &--transparent {
      background-color: transparent;
      .nav-link, .dropdown--up-mobile { color: #fff !important }
      .nav__links-container, .nav__logo {
        background: transparent;
      }
      .nav__cta .btn {
        background-color: @color-lightbulb;
        color: @color-text;
      }
      .nav__logo {
        svg {
          fill: #fff;
        }
      }
    }

    &__logo {
      position: fixed;
      top: 0;
      left: 0;
      height: 3.75rem;
      width: 100%;
      z-index: 50;
      background: #fff;
      display: flex;
      justify-content: center;
      .transition('background-color');

      svg {
        max-width: 17.5rem;
        @media @medium {
          width: 17.5rem;
        }
      }

      @media @medium {
        position: static;
        height: auto;
        width: auto;
        display: inline-flex;
        flex: 0 1 auto;
      }
    }
    &__links-container {
      display: flex;
      list-style: none;
      align-items: center;
      justify-content: space-between;
      position: fixed;
      bottom: 0;
      width: 100%;
      height: 3.125rem;
      margin: 0;
      padding-left: 0;
      left: 0;
      background-color: white;
      z-index: 50;
      .transition('background-color');

      > li {
        flex: 0 1 auto;
      }

      @media @medium {
        position: static;
        height: auto;
        width: auto;
        display: inline-flex;
        flex: 1 0 auto;
        justify-content: space-around;
        max-width: @max-width - 280px;
      }
    }

    &__link-container {
      margin: 0 0 0 auto;

      .nav-link { padding-bottom: 0 }

      .dropdown--up-mobile {
        font-size: 1rem;
        position: relative;
        color: @color-text;
        ul {
          // TODO: review w/ design
          padding: 1.5rem 2.5rem;
          list-style: none;
          .transition(transform);
          transform-origin: bottom;
          transform: scaleY(0);
          position: absolute;
          left: -50%;
          background-color: #fff;
          bottom: 2.375rem;

          li {
            a {
              color: @color-text;
              &:hover {
                color: @color-cobalt;
              }
            }
          }
        }

        &--active {
          ul {
            transform: scaleY(1);
          }
        }

        @media @medium {
          font-size: 1.25rem;
          ul {
            box-shadow: 3px 11px 15px -2px rgba(0, 1, 95, 0.07);
            transform-origin: top;
            top: 3.95rem;
            bottom: auto;
          }
        }
      }
    }

    &__cta {
      margin: 0 0 0 auto;

      .btn {
        margin: 0;
        padding: .7em 1em;

        @media @large {
          padding: 0.7em 2.95em;
        }
      }
    }
  }
</style>
