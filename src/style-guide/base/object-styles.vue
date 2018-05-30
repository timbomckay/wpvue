<template>
  <main class="slim-container">
    <h2>Object Styles</h2>

    <h3>Shadows</h3>
    <div class="shadowboxes">
      <div class="shadowbox"><code>.shadow-1</code></div>
      <div class="shadowbox"><code>.shadow-2</code></div>
    </div>

    <h3>Overlays</h3>
    <p>All of these boxes have a <code>background-color</code> of <code class="text-cobalt-lighter">@color-cobalt-lighter</code></p>
    <div class="overlayboxes">
      <div class="overlaybox"><code>.overlay-15</code></div>
      <div class="overlaybox"><code>.overlay-25</code></div>
      <div class="overlaybox"><code>.overlay-40</code></div>
      <div class="overlaybox"><code>.overlay-50</code></div>
    </div>

    <h3>Patterns</h3>
    <p>TODO</p>
  </main>
</template>

<script>
export default {
  name: 'sg-object-styles'
}
</script>

<style lang="less">
@import '../../utils/variables';
@import '../../utils/helper-other';

  .shadowboxes {
    display: flex;
    width: calc(100% + 2rem);
    margin-left: -1rem;
    margin-right: -1rem;
  }
  .shadowbox {
    flex: 1 1 270px;
    height: 180px;
    margin: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;

    &:first-child {
      background-color: @color-cobalt;
      code { color: #fff }
      .shadow-1;
      transition-property: box-shadow;
      transition-duration: 0.2s;
      transition-timing-function: ease-in-out;
    }

    &:last-child {
      background-color: @color-lightbulb;
      .shadow-2;
    }
  }

  .overlaybox {
    width: 100%;
    height: 250px;
    margin-bottom: 1rem;
    text-align: center;
    background-color: @color-cobalt-lighter;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    code {
      color: #fff;
    }

    &:after {
      position: absolute;
      content: '';
      z-index: 1;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
    }
    &:nth-child(1):after { .overlay-15 }
    &:nth-child(2):after { .overlay-25 }
    &:nth-child(3):after { .overlay-40 }
    &:nth-child(4):after { .overlay-50 }
  }
</style>
