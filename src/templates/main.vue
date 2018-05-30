<template>
  <div class="example">{{ msg }}</div>
</template>

<script>
export default {
  name: 'Main',
  data () {
    return {
      msg: 'Hello world!'
    }
  }
}
</script>

<style lang="less">
.vuestyle {
  display: grid;
  transition: all .5s;
  user-select: none;
  background: linear-gradient(to bottom, white, black);
}
.another {
  font-size: 16px;
  color: blue;
}
</style>
