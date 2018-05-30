<template lang="html">
  <div class="style-guide" @click='toggleClosures'>
    <sg-nav></sg-nav>
    <transition name="fade">
      <div class="style-guide--body">
        <router-view></router-view>
      </div>
    </transition>
  </div>
</template>

<script>
import sgnav from './sg-nav.vue';

export default {
  name: 'app',
  components: {
    'sg-nav': sgnav
  },
  data() {
    return {

    }
  },
  methods: {
    toggleClosures(e) {
      this.$emit('close-toggles', e.target);
    }
  }
}
</script>

<style lang="less">
@import "../utils/variables.less";

.style-guide {
  padding-left: 4rem;

  .slim-container {
    width: 100%;
    max-width: 75rem;
    padding-left: 2rem;
    padding-right: 2rem;
    margin: 2rem auto 4rem;
  }

  &--body {
    display: flex;
    padding: 1rem;
    flex-direction: column;
    height: 100%;
    min-height: calc(100vh - 30px);
    transition: background-color .2s ease-in-out;
  }
}

</style>
