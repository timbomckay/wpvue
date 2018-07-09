<template>
  <transition name="slide-fade" mode="out-in">
    <router-view></router-view>
  </transition>
</template>

<script>
export default {
  name: 'Main',
  data () {
    return {
      msg: 'Hello World!'
    }
  }
}
</script>

<style lang="scss">
/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.2s ease-in-out;
}
.slide-fade-enter, .slide-fade-leave-to {
  opacity: 0;
}
.slide-fade-enter, .slide-fade-leave-to {
  transform: translateY(10px);
}
</style>
