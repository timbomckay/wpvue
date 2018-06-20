<template>
  <main class="slim-container">
    <wpvue-nav :cta="cta" :links="links" :logo="logo"></wpvue-nav>
    <h2 style="margin-top: 7.5rem">Nav</h2>
    <section>
    <p>This nav has a transparent mode in which the text becomes white and the background transparent.
    Click here to <button class="btn-sm" @click='toggleNavTransparency'>toggle transparency</button></p>
    <p>The scrolling logic for the homepage is still needed.</p>
    </section>
  </main>
</template>

<script>
import wpvueNav from '../../components/wpvue-nav.vue';

export default {
  name: 'nav',
  components: {
    'wpvue-nav': wpvueNav
  },
  data() {
    return {
      cta: {
        title: 'Contact',
        href: '/contact'
      },
      links: [
        {title: 'Work', href: '/work', active: false},
        {title: 'Process', href: '/process', active: false},
        {title: 'Team', href: '/team', active: true},
        {
          title: 'More',
          drop: [
            {title: 'Services', href: '/services'},
            {title: 'Awards', href: '/awards'},
            {title: 'Blog', href: '/blog'}
          ]
        }
      ],
      logo: {
        src: '/wp-content/themes/wpvue/images/branding/logo.svg'
      }
    }
  },
  methods: {
    toggleNavTransparency() {
      document.querySelector('.nav').classList.toggle('nav--transparent');
      document.querySelector('.style-guide--body').classList.toggle('bg-aqua-lighter');
    }
  }
}
</script>

<style lang="scss">
  .bg-aqua-lighter {
    background-color: #ddd;
  }
</style>
