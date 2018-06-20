<template>
  <main class="slim-container">
    <h2>Links</h2>
    <p>There are 4 types of links with a few variations: CTAs (<code>.cta</code>), Nav (<span><code>.nav-link</code></span>), Inline (<span><code>&lt;a href='...'&gt;</code></span>), and Drops (<span><code>.dropdown</code></span>, <span><code>.dropup</code></span>, <span><code>.expand</code></span>)</p>
    <p>The variations only affect the position (left or right) and the rotation of an arrow or expand icon</p>

    <h3>CTAs</h3>
    <p>Here is a <a href="#" class="cta">Primary Link</a> using <code>.cta</code></p>
    <p>And this is <a href="#" class="cta--left">Primary Link Left</a> using <code>.cta--left</code></p>

    <hr>

    <h3>Nav links</h3>
    <p>Nav links use the class <code>.nav-link</code> with the modifier <code>--active</code> to mark the active state.</p>
    <nav style="list-style: none; display: inline-flex">
      <a href="#" class="nav-link">Nav Link</a>
      <a href="#" class="nav-link nav-link--active">Nav Link Active</a>
    </nav>

    <hr>

    <h3>Drops (dropdown, dropup, expand)</h3>
    <p>These all have a sizing modifier of <code>--sm</code> for 1rem. Default is 1.25rem (20px)</p>
    <a href="#" class="dropdown">dropdown</a> <code>.dropdown</code><br>
    <a href="#" class="dropup">dropup</a> <code>.dropup</code><br>
    <a href="#" class="expand">Expand</a> <code>.expand</code>

    <hr>

  </main>
</template>

<script>
export default {
  name: 'sg-links'
}
</script>

<style lang="scss">

</style>
