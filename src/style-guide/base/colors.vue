<template>
  <main class="slim-container">
    <textarea id="hex-input" style="opacity:0; height: 0; width: 0;"></textarea>
    <!-- Colors -->

    <p>
      The color variables are:
      <code>$color-lightbulb-darker</code> ,
      <code>$color-lightbulb-dark</code> ,
      <code>$color-lightbulb,</code> ,
      <code>$color-lightbulb-light</code>,
      <code>$color-lightbulb-lighter</code>,
      <code>$color-primary-darker</code>,
      <code>$color-primary-dark</code>,
      <code>$color-primary</code>,
      <code>$color-primary-light</code>,
      <code>$color-primary-lighter</code>,
      <code>$color-aqua-darker</code>,
      <code>$color-aqua-dark</code>,
      <code>$color-aqua</code>,
      <code>$color-aqua-light</code>,
      <code>$color-aqua-lighter</code>
      <code>$color-icy-darker</code>
      <code>$color-icy-dark</code>,
      <code>$color-icy</code>,
      <code>$color-blackout-dark</code>,
      <code>$color-blackout</code>,
      <code>$color-blackout-light</code>,
      <code>$color-blackout-lighter</code>
    </p>
    <section>
      <div class="color-boxes">
        <div class="color-box" v-for="(textColor, key) in textColors" :key="key">
          <div :class="textColor.isLight ? 'color color__text-dark' : 'color'"
               :style="`background-color: ${textColor.color}`"
               @click="copyColorToClipboard($event, textColor.color)">Copy Color</div>
          <p>{{ textColor.name }}</p>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
let hexinput;
export default {
  name: 'sg-colors',
  data() {
    return {
      textColors: [
        {name: 'lightbulb-darker', color: 'rgb(203, 166, 0)'},
        {name: 'lightbulb-dark', color: 'rgb(229, 192, 0)'},
        {name: 'lightbulb', color: 'rgb(254, 217, 2)'},
        {name: 'lightbulb-light', color: 'rgb(255,243,28)', isLight: true},
        {name: 'lightbulb-lighter', color: 'rgb(255, 255, 104)', isLight: true},
        {name: 'cobalt-darker', color: 'rgb(0, 1, 124)'},
        {name: 'cobalt-dark', color: 'rgb(15, 27, 150)'},
        {name: 'cobalt', color: 'rgb(40, 52, 175)'},
        {name: 'cobalt-light', color: 'rgb(78, 90, 213)'},
        {name: 'cobalt-lighter', color: 'rgb(104, 116, 239)'},
        {name: 'aqua-darker', color: 'rgb(66, 197, 200)'},
        {name: 'aqua-dark', color: 'rgb(92, 223, 226)'},
        {name: 'aqua', color: 'rgb(117, 248, 251)', isLight: true},
        {name: 'aqua-light', color: 'rgb(168, 255, 255)', isLight: true},
        {name: 'aqua-lighter', color: 'rgb(219, 255, 255)', isLight: true},
        {name: 'icy-darker', color: 'rgb(218, 230, 230)', isLight: true},
        {name: 'icy-dark', color: 'rgb(230, 242, 242)', isLight: true},
        {name: 'icy', color: 'rgb(243, 255, 255)', isLight: true},
        {name: 'blackout-dark', color: 'rgb(36, 36, 36)'},
        {name: 'blackout', color: 'rgb(45, 45, 45)'},
        {name: 'blackout-light', color: 'rgb(71, 71, 71)'},
        {name: 'blackout-lighter', color: 'rgb(235, 235, 235)', isLight: true}
      ],
    }
  },
  mounted() {
    hexinput = document.getElementById('hex-input');
  },
  methods: {
    copyColorToClipboard(e, color) {
      let oldtext = e.target.innerText;

      hexinput.value = 'color';
      hexinput.select();
      document.execCommand('copy');

      e.target.innerText = ((color.indexOf('#') > -1) || (color.indexOf('rgb') > -1)) ? (color + " copied!") : "Gradient copied!";
      e.preventDefault();
      setTimeout(function() {
        e.target.innerText = oldtext;
      }, 5000);
    }
  }
}
</script>

<style lang="scss">

  .color-boxes {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
  }

  .color-box {
    flex: 1 1 200px;
    margin: .5rem;
    max-width: 200px;

    p {
      padding: .5rem;
      padding-left: 0;
      margin-top: 0;
      font-weight: bold;
    }
  }

  .color {
    height: 150px;
    transition: all .15s;
    cursor: pointer;
    color: transparent;
    text-align: center;
    padding-top: calc(75px - .5rem);
    font-weight: 700;

    &:hover {
      transform: scale(1.07);
      color: #fff;
    }
    &__text-dark:hover {
      color: #6b6b6b;
    }
  }
</style>
