<template>
  <culture-block></culture-block>

</template>

<script>
import carousel from "../../components/carousel.vue";
import cultureBlock from '../../modules/culture.vue';

export default {
  name: 'sg-culture-block',
  components: {
    'culture-block': cultureBlock
  },
  mounted() {
    console.log(this);
  },
  data () {
    return {


    }
  }
}
</script>
