<template>
  <div>
    <div class="slim-container"><h1>Carousel Component</h1></div>
    <div v-for="(example, key) in examples" :key="key">
      <h2>Image</h2>
      <h3>Caption</h3>
      <div class="row">
        <div class="col">
          <carousel type="image__caption" :slides="example.slides"></carousel>
        </div>
      </div>
      <h3>No Caption</h3>
      <div class="row">
        <div class="col col-sm-4">
          <carousel type="image__no-caption" :slides="example.slides"></carousel>
        </div>
      </div>
      <h2>Process</h2>
      <div class="row">
        <div class="col">
          <carousel type="process" :slides="example.process"></carousel>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import carousel from "../../components/carousel.vue";

export default {
  name: 'sg-carousel',
  components: {
    carousel
  },
  data () {
    return {
      examples: [
        {
          slides: [
            {
              type: 'image',
              image: {
                title: {
                  rendered:'Nature Title'
                },
                url: 'https://placeimg.com/1000/500/nature',
                caption: {
                  rendered: 'This is the caption return for Nature'
                }
              }
            },
            {
              type: 'image',
              image: {
                title: {
                  rendered:'Animal Title'
                },
                url: 'https://placeimg.com/1000/500/animals',
                caption: {
                  rendered: 'This is the caption return for Animal'
                }
              }
            },
            {
              type: 'image',
              image: {
                title: {
                  rendered:'Tech Title'
                },
                url: 'https://placeimg.com/1000/500/tech',
                caption: {
                  rendered: 'This is the caption return for Tech'
                }
              }
            }
          ],
          process: [
            {
              type: 'headline',
              title: 'But What is "Discovery?"',
              content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis tincidunt risus. Donec vel elit vitae justo porta hendrerit. Aenean dapibus neque magna.',
              graphic: ''
            },
            {
              type: 'headline',
              title: 'But 2',
              content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis tincidunt risus. Donec vel elit vitae justo porta hendrerit. Aenean dapibus neque magna.',
              graphic: ''
            },
            {
              type: 'headline',
              title: 'But Why Do A "Discovery?"',
              content: 'Testus Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis tincidunt risus. Donec vel elit vitae justo porta hendrerit. Aenean dapibus neque magna.',
              graphic: ''
            }
          ],
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
            }
          ]
        }
      ]
    }
  }
}
</script>
