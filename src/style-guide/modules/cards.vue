<template>
  <div>
    <div class="slim-container"><h1>Team Card (Carousel) Module</h1>
      <div v-for="(example, key) in examples" :key="key">
          <card type="team" :people="example.members"></card>
      </div>
    </div>
    <div class="slim-container"><h1>Team Card (Individual) Module</h1>
      <div v-for="(single, key) in examples" :key="key" class="row">
        <div v-for="(people, key) in single.team" :key="key" class="col-sm-12 col-md-4">
          <card type="individual" :people="people"></card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import card from "../../modules/cards.vue";

export default {
  name: 'sg-cards',
  components: {
    card
  },
  data() {
    return {
      examples: [
        {
          members: [
            {
              name: 'Sample Person',
              image: {
                title: {
                  rendered:'Person Image'
                },
                url: 'https://placeimg.com/320/420/people/sepia',
              },
              title: 'Sample Job Title',
              cta_text: 'Meet Sample',
              page_link: {
                link:"http://www.wpvue.localhost/carousel"
              },
              hover_color: 'aqua'
            },
            {
              name: 'Johnny Sampleson',
              image: {
                title: {
                  rendered:'Sampleson Image'
                },
                url: 'https://placeimg.com/320/420/people/sepia',
              },
              title: 'Sample Job Title',
              cta_text: 'Meet Johnny',
              page_link: {
                link:"http://www.wpvue.localhost/carousel"
              },
              hover_color: 'lightbulb'
            },
            {
              name: 'Freddy Tester',
              image: {
                title: {
                  rendered:'Tester Image'
                },
                url: 'https://placeimg.com/320/420/people/sepia',
              },
              title: 'Sample Job Title',
              cta_text: 'Meet Freddy',
              page_link: {
                link:"http://www.wpvue.localhost/carousel"
              },
              hover_color: 'aqua'
            },
            {
              name: 'Susie Sampler',
              image: {
                title: {
                  rendered:'Sampler Image'
                },
                url: 'https://placeimg.com/320/420/people/sepia',
              },
              title: 'Sample Job Title',
              cta_text: 'Meet Susie',
              page_link: {
                link:"http://www.wpvue.localhost/carousel"
              },
              hover_color: 'lightbulb'
            }
          ],
          team: [
            {
              name: 'Sample Person',
              image: {
                title: {
                  rendered:'Person Image'
                },
                url: 'https://placeimg.com/320/420/people/sepia',
              },
              title: 'Sample Job Title',
              cta_text: 'Meet Sample',
              page_link: {
                link:"http://www.wpvue.localhost/carousel"
              },
              hover_color: 'aqua'
            },
            {
              name: 'Johnny Sampleson',
              image: {
                title: {
                  rendered:'Sampleson Image'
                },
                url: 'https://placeimg.com/320/420/people/sepia',
              },
              title: 'Sample Job Title',
              cta_text: 'Meet Johnny',
              page_link: {
                link:"http://www.wpvue.localhost/carousel"
              },
              hover_color: 'lightbulb'
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
