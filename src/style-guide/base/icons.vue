<template>
  <article class="slim-container">
    <h1>Icons</h1>
    <p>SVG symbols are like image sprites, but significantly better. It utilizes the same method of one file for many images for caching purposes, but instead of having to define a background size and position for each image we just provide the ID of the image we want. No need to duplicate images for default, active and hover states as the svgs can alter colors. No need for multiple sizes since svgs scale to always provide a crisp image. There are some odd svg quirks that come with this system, but the benefits far outweigh the few technicial hurdles.</p>

    <p>Here's an example of how to use an svg sprite:</p>

    <p>Providing the <code>icon</code> class to the <code>svg</code> tag will do two things:</p>

    <ol style="list-style:decimal; padding-left:1rem;">
      <li style="margin-bottom:1rem;">Apply the current color to the symbol's fill color
        <ul style="lpadding-left:1rem;">
          <li style="margin:0.5rem 0;">If there's not a color specified like the multi-colored icons in the first group below, the fill color will inherit the color of the parent element. If a button with a green background has white color text, the icon included will inherit the white. A green anchor link will display a green icon.</li>
          <li style="margin:0.5rem 0;"><a href="#">Helper class</a> colors can also be applied to the <code>svg.icon</code> to alter the fill color.</li>
        </ul>
      </li>
      <li style="margin-bottom:1rem;">Defines a height & width of <code>1em</code> to match the font-size of the current element
        <ul style="padding-left:1rem;">
          <li style="margin:0.5rem 0;">Icons are typically used in a button or alongside some text. Inheriting the font-size displays the icon at the same size as the neighboring text.</li>
          <li style="margin:0.5rem 0;">Font-sizes can be specified with the <a href="/style-guide/buttons" target="_new">bootstrap button classes</a> for buttons
            <br>or inline with <code>style=&#x22;font-size:___&#x22;</code>
            <br>or with one of the provided font-size classes below:
            <ul>
              <li><code>.fs-xxl = 36px</code></li>
              <li><code>.fs-xl = 24px</code></li>
              <li><code>.fs-lg = 20px</code></li>
              <li><code>.fs-med = 18px</code></li>
              <li><code>.fs-reg = 16px</code></li>
              <li><code>.fs-sm = 14px</code></li>
              <li><code>.fs-xs = 12px</code></li>
            </ul>
          </li>
        </ul>
      </li>
    </ol>

    <h3>Image Source</h3>

    <p>SVGs also work as image sources. There may be scenarios where the svg sprite isn't an option either from complexity of the icon or sizing difficulties as defined below. Used in an image tag, the svg acts as any other image scaling respectively but removes the ability to alter colors.</p>

    <p>Example of svg as an image source:</p>

    <h3>SVG <i>vs</i> SVG.ICON <i>vs</i> IMG</h3>

    <div class="row">
      <div class="col-3">
        <svg style="padding: 1rem;border: 1px solid #e1e1e1"><use :href="path + '/images/sprite.svg#logo'"></use></svg>
        <h6>svg</h6>
      </div>
      <div class="col-auto">
        <icon href="logo" style="padding: 1rem;border: 1px solid #e1e1e1;font-size:8rem;"></icon>
        <h6>svg.icon</h6>
      </div>
      <div class="col">
        <img :src="path + '/images/branding/logo.svg'" class="bg-white border" style="padding: 1rem;">
        <h6>img</h6>
      </div>
    </div>

    <p>The plain svg has a set max-height &amp; max-width of 100% so it doesn't go beyond the parent boundaries, but it won't maintain the aspect ratio. The image itself maintains its aspect ratio but creates an invisible boundary to the height of the svg. The image on the left shows the svg height at about 150px, which is what the svg is defined to be, but the width scales down from 300px to the width of the container.</p>
    <p>An svg tag with the <code>icon</code> class will set the height and width to 1em, as detailed above. If the icon isn't a 1:1 aspect ratio you can alter the height or width accordingly. For instance, the logo is about 3:1 so we could adjust the width with <code>style="width:3em"</code> to scale appropriately with the font-size. However, the logo appears to be the only svg that's not a square and we use the image source for better reliability.</p>

    <h2>Icons</h2>
    <div class="row">
      <div v-for="(id, key) in icons" :key="key" class="col-3 text-center" style="margin-bottom:2rem;">
        <icon :href="id" style="font-size:3rem;margin-bottom:0.5rem;"></icon>
        <pre>{{ id }}</pre>
      </div>
    </div>

    <h2>Illustrations</h2>
    <div class="row">
      <div v-for="(id, key) in symbols" :key="key" class="col-3 text-center" style="margin-bottom:2rem;">
        <icon :href="id" :icon="false" style="font-size:3rem;margin-bottom:0.5rem;"></icon>
        <pre>{{ id }}</pre>
      </div>
    </div>

  </article>
</template>

<script>
export default {
  name: 'Icons',
  computed: {
    path: function () {
      return THEME_URI
    },
    icons: function () {
      let ids = [
        'logo', 'logo-vertical', 'logo-symbol', 'adk',
        'check', 'chevron-double-down', 'chevron-left', 'chevron-right',
        'pointer-up','pointer-down','pointer-left','pointer-right',
        'minus', 'plus', 'diamond', 'diamond-outline',
        'calendar', 'location', 'quote',
        'link', 'envelope', 'facebook', 'instagram',
        'linkedin', 'twitter'
      ]
      return ids
    },
    symbols: function () {
      let ids = [
        'i-bourbon', 'i-calendar', 'i-globe', 'i-integrity',
        'i-microphone', 'i-money', 'i-positivity', 'i-up-arrow-white',
        'i-up-arrow', 'i-workout'
      ]
      return ids
    }
  }
}
</script>

<style lang="css">
</style>
