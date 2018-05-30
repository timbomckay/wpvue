<template>
  <div>
    <div class="slim-container">
      <h1>Bumper Newsletter</h1>
      <div class="row">
        <bumper class="col col-sm-6" type="newsletter"></bumper>
      </div>
    </div>
    <div class="slim-container"><h1>Bumper Standard</h1>
      <div class="row" v-for="(example, key) in examples" :key="key">
        <bumper class="col-6" type="standard" :content="example.bumpers"></bumper>
      </div>
    </div>
    <!-- <div class="slim-container"><h1>Bumper Open</h1>
      <bumper type="open"></bumper>
    </div> -->
  </div>
</template>

<script>
import bumper from "../../modules/bumper.vue";

export default {
  name: 'sg-bumper',
  components: {
    bumper
  },
  data() {
    return {
      examples: [
        {
          bumpers: [
            {
              post_type: '',
              preheading: 'Preheading',
              image: 'https://placeimg.com/1000/500/arch',
              title: 'Title, For Lack of Better Words'
            }
          ]
        }
      ]
    }
  }
}
</script>

<style lang="css">
</style>
