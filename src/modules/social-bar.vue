<template>
  <div class="social-bar">
    <a href="//www.facebook.com/blackstonemedia"><icon :href="'facebook'" class= "fs-l"></icon></a>
    <a href="//www.twitter.com/teamblackstone"><icon :href="'twitter'" class="fs-l"></icon></a>
    <a href="//www.instagram.com/teamblackstone"><icon :href="'instagram'" class="fs-l"></icon></a>
    <a href="//www.linkedin.com/company/blackstone-media-network"><icon :href="'linkedin'" class="fs-l"></icon></a>
  </div>
</template>

<script>
  export default {
    name: 'social-bar',
    data() {
      return {

      }
    }
  }
</script>

<style lang="less">
  .social-bar {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin: 1rem 0;
    a {
        margin: 0 .6rem;
    }
  }
</style>
