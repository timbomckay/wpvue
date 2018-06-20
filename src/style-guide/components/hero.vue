<template>
  <div>
    <div class="slim-container"><h1>Hero Components</h1></div>
    <div class="mb-2" v-for="(example, key) in examples" :key="key">
      <div><h3>{{ example['sg-name'] }} </h3></div>
      <hero :content="example.content" :type="example.type"></hero>
    </div>
  </div>
</template>

<script>
import hero from "../../components/hero.vue";
export default {
  name: 'sg-hero',
  components: {
    hero
  },
  data () {
    return {
      examples: [
        {
          'sg-name': 'Case Study',
          type: 'caseStudy',
          content: {
            headline: 'What We Do Headline',
            image: 'https://placeimg.com/1000/400/nature',
            subhead: 'One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.',
            title: 'The Title',
            content: 'The Content'
          }
        },
        {
          'sg-name': 'Split-content / "Services"',
          type: 'split-content', // 'type' would be provided by something outside of the ACF data
          content: {
            headline: 'What We Do Headline',
            subhead: 'One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. '
          }
        }
      ]
    }
  }
}
</script>
<style lang="scss">

</style>
