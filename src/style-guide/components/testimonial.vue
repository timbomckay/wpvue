<template>
  <div class="container slim-container"><h1>Hero Component</h1>
    <h3>Testimonial - 12 col</h3>
    <div class="row">
      <testimonial class="col" v-for="(example, key) in examples" :key="key" :content="example.content"></testimonial>
    </div>
    <h3>Testimonial - 6 col (.col-md-6) | Mobile</h3>
    <div class="row">
      <testimonial class="col-md-6" v-for="(example, key) in examples" :key="key" :content="example.quote_two"></testimonial>
    </div>
  </div>
</template>

<script>
import testimonial from "../../components/testimonial.vue";

export default {
  name: 'sg-testimonial',
  components: {
    testimonial
  },
  data () {
    return {
      examples: [
        {
          content: {
            name:'Stephanie Henegar',
            quote:'We gained valuable insight and suggestions from our users…Blackstone helped us implement what added the most value. From start to finish, Blackstone Media continues to do a fantastic job for us!',
            title:'Principal'
          },
          quote_two: {
            name:'Somebody',
            quote:'Blackstone\'s great! They provided a great user experience all the while helping me to achive my end goals. Becuase of them I am on to bigger and better things!',
            title:'That You Used To Know'
          }
        }
      ]
    }
  }
}
</script>
