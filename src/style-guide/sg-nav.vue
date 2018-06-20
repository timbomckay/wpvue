<template>
  <nav id="styleguide-nav" class="styleguide-nav" :class="{'styleguide-nav--expand': showNav}">
    <div class="theme-links">
      <div class="column">
        <a href="/" class="logo-icon"><img :src="favicon" style="width:2rem;"/></a>
        <a id="sgNav-trigger" @click="showNav = !showNav"><span></span><span></span><span></span><span></span></a>
      </div>
      <div class="column col2">
        <h3 style="margin-bottom:0;">WP+Vue</h3>
        <h4 class="text-primary" style="margin-top:0;">Style Guide</h4>
        <div v-for="(items, index) in navItems" :key="index">
          <label v-if="items.name">{{ items.name }}</label>
          <router-link v-for="(link, index) in items.links" :key="index" :to="'/style-guide/' + link.slug" @click.native="showNav = !showNav">{{ link.name }}</router-link>
        </div>
      </div>
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
      {name: 'Links', slug: 'links'}
    ],
  },
  {
    name: 'Modules',
    links: [
      {name: 'Cards', slug: 'cards'}
    ],
  },
  {
    name: 'Components',
    links: [
      {name: 'Hero', slug: 'hero'},
      {name: 'Carousel', slug: 'carousel'},
      {name: 'Footer', slug: 'footer'},
      {name: 'Nav', slug: 'wpvue-nav'}
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

<style lang="scss">
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
    background-color: $color-primary;
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
