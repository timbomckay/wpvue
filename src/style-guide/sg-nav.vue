<template>
  <nav id="styleguide-nav" class="styleguide-nav" :class="{'styleguide-nav--expand': showNav}">
    <div class="theme-links">
      <div class="column">
        <a href="/" class="logo-icon"><img :src="favicon" style="width:2rem;"/></a>
        <a id="sgNav-trigger" @click="showNav = !showNav"><span></span><span></span><span></span><span></span></a>
      </div>
      <div class="column col2">
        <h3 style="margin-bottom:0;">Blackstone Media</h3>
        <h4 class="text-primary" style="margin-top:0;">Style Guide</h4>
        <div v-for="(items, index) in navItems" :key="index">
          <label v-if="items.name">{{ items.name }}</label>
          <router-link v-for="(link, index) in items.links" :key="index" :to="'/style-guide/' + link.slug" @click.native="showNav = !showNav">{{ link.name }}</router-link>
        </div>
      </div>
    </div>
    <div class="blackstone-links column">
      <a href="https://www.blackstonemedia.com/" target="_blank">
        <img style="width:2rem;" src="data:image/png;base64,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"/>
        <!-- Blackstone Media -->
      </a>
    </div>
  </nav>
</template>

<script>
const navItems = [
  // Follow this pattern for more links
  // {
  //   name: 'Section', // Nav Category
  //   links: [
  //     {name: 'Example', slug: 'example'}
  //   ]
  // }
  {
    name: 'Base',
    links: [
      {name: 'Colors', slug: 'colors'},
      {name: 'Typography', slug: 'typography'},
      {name: 'Icons', slug: 'icons'},
      {name: 'Buttons', slug: 'buttons'},
      {name: 'Forms', slug: 'forms'},
      {name: 'Shadows & Overlays', slug: 'object-styles'},
      {name: 'Links', slug: 'links'}
    ],
  },
  {
    name: 'Modules',
    links: [
      {name: 'Cards', slug: 'cards'},
      {name: 'Cards (Bumper)', slug: 'bumper'}
    ],
  },
  {
    name: 'Components',
    links: [
      {name: 'Hero', slug: 'hero'},
      {name: 'Carousel', slug: 'carousel'},
      {name: 'Culture Block', slug: 'culture-block'},
      {name: 'Testimonial', slug: 'testimonial'},
      {name: 'Footer', slug: 'footer'},
      {name: 'Filters', slug: 'filters'},
      {name: 'Nav', slug: 'bsm-nav'},
      {name: 'Case Study', slug: 'case-study'}
    ],
  },
]

export default {
  name: 'sg-nav',
  components: {},
  data() {
    return {
      navItems: navItems,
      showNav: false,
      favicon: THEME_URI + '/images/favicon/favicon-96x96.png'
    }
  }
}
</script>

<style lang="less">
@import "../utils/variables.less";

.styleguide-nav {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  width: 4rem;
  background-color: whitesmoke;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition-property: top, left, bottom;
  transition-duration: 0.2s;
  transition-timing-function: ease-in-out;
  z-index: 51;

  .admin-bar & { top: 32px; }

  &:not(.styleguide-nav--expand):after {
    opacity: 0;
    visibility: hidden;
  }

  &:before {
    display: block;
    content: '';
    background-color: @color-primary;
    top: 0;
    left: 0;
    position: absolute;
    width: 0;
    height: 0;
    z-index: 1;
    opacity: 0.75;
    transition-property: top, left, height, width;
    transition-duration: 0.2s;
    transition-timing-function: ease-in-out;
  }

  &:after {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.75);
    transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out;
  }

  &--expand {
    top: 1rem;
    left: 1rem;
    bottom: 1rem;

    .admin-bar & { top: 3rem; }

    &:before {
      top: 0.5rem;
      left: 0.5rem;
      width: 24rem;
      height: 100%;
    }

    .column.col2 {
      left: 100% !important;
      transform: scaleX(1) !important;
      overflow-y: auto !important;
    }
  }

  label {
    display: block;
    margin-top: 2rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.125em;
    font-size: 0.9rem;
  }

  .column {
    padding: 1rem;
    background-color: whitesmoke;
    z-index: 1;
    &.col2 {
      position: absolute;
      top: 0;
      left: 0;
      width: 20rem;
      transform: scaleX(0);
      transform-origin: 0 50%;
      height: 100%;
      transition-property: left, transform;
      transition-duration: 0.2s;
      transition-timing-function: ease-in-out;
      z-index: 0;
      overflow: hidden;

      a {
        display: block;
        padding: 0.5rem 1rem;
        margin-left: -1rem;
        transition-property: background-color;
        transition-duration: 0.2s;
        transition-timing-function: ease-in-out;
        &:hover, &.active {
          text-decoration: none;
          background-color: white;
        }
      }

    }
  }

  .theme-links {
    flex-grow: 1;
    display: flex;
    z-index: 1;
  }

  .blackstone-links {
    z-index: 2;
  }

}

#sgNav-trigger {
  width: 1.75rem;
  height: 2rem;
  display: block;
  position: relative;
  margin: 2rem auto;
  transform: rotate(0deg);
  transition: .2s ease-in-out;
  cursor: pointer;

  span {
    display: block;
    position: absolute;
    height: 3px;
    width: 100%;
    background: #4d4d4d;
    opacity: 1;
    left: 0;
    -webkit-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    -webkit-transition: .2s ease-in-out;
    -o-transition: .2s ease-in-out;
    transition: .2s ease-in-out;
    &:nth-child(1) {
      top: 0px;
      .expand & {
        top: 8px;
        width: 0%;
        left: 50%;
      }
    }
    &:nth-child(2) {
      top: 10px;
      .expand & {transform: rotate(45deg);}
    }
    &:nth-child(3) {
      top: 10px;
      .expand & {transform: rotate(-45deg);}
    }
    &:nth-child(4) {
      top: 20px;
      .expand & {
        top: 8px;
        width: 0%;
        left: 50%;
      }
    }
  }
}
</style>
