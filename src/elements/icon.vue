<template>
  <svg :class="{icon: icon}">
    <use :xlink:href="`${path}#${href}`"></use>
  </svg>
</template>

<script>
import * as axios from 'axios'

let isIE11 = !!window.MSInputMethodContext && !!document.documentMode
let url = `${THEME_URI}/images/sprite.svg`

if (isIE11) {
  axios.get(url)
    .then(function (response) {
      var div = document.createElement('div')
      div.innerHTML = response.data
      div.style.display = 'none'
      document.body.insertBefore(div, document.body.childNodes[0])
      // add .ie to <body>
      document.body.classList.add('ie')
    })
}

export default {
  name: 'icon',
  props: {
    icon: {
      type: Boolean,
      default: true
    },
    href: {
      type: String,
      required: true
    }
  },
  computed: {
    path () {
      return !isIE11 ? url : ''
    }
  }
}
</script>

<style lang="less">
@import '../utils/mixins';

svg {
  max-width: 100%;
  max-height: 100%;
  .transition('fill');

  &.icon {
    height: 1em;
    width: 1em;
    fill: currentColor;

    a & { color: inherit; }

  }

}
</style>
