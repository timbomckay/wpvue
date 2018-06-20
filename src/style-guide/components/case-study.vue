<template>
  <main class="container">
    <h2>Case Study Blocks</h2>
    <section>
      <p>Case Study takes 7 props: headline, summary, textColor, cta, logo, background, and floatImage</p>
      <p>
        The <code>h2</code> hosts <code>:headline</code> (String).<br>
        Below the heading is <code>:summary</code> (String).<br>
        <code>:cta</code> is an Object with 3 required properties: title, type(primary or secondary), and href.<br>
        The <code>textColor</code> prop (String) accepts either 'light' or 'dark' (default).<br>
        Logo (<code>:logo</code>, Object) has 2 properties: 'href' and 'alt'<br>
        <code>:background</code> (String) is the href for a background image on the block.
      </p>
      <p>
        Last, <code>:floatImage</code> (Object) should contain 4 properties: href, alt, offset (Object), and sizeModifier.
        Offset should have <code>bottom</code> and <code>right</code> proerties (Number) which are passed as percentage translations
        (e.g. <code>offset: {right: 15, bottom: -20}</code> equates <code>transform: translate(15%, -20%)</code>)
      </p>
    </section>

    <section class="case-study-sizers py-1">
      <p>Use the tool below to plan the placement of the floating image.</p>
      <button class="btn-sm btn-primary" @click="toggleTemp">Toggle Light</button>
      <button class="btn-sm btn-primary" @click="toggleBtnType">Toggle Type</button>
      <div class="form-control">
        <label class="case-study__toggle-label" for="right">Right ({{ floatImage.offset.right }})</label>
        <input id="right" type="range" min="-100" max="100" step="1" v-model="floatImage.offset.right">
      </div>
      <div class="form-control">
        <label class="case-study__toggle-label" for="bottom">Bottom ({{ floatImage.offset.bottom }})</label>
        <input id="bottom" type="range" min="-100" max="100" step="1" v-model="floatImage.offset.bottom">
      </div>
      <div class="form-control">
        <label class="case-study__toggle-label" for="size">Size ({{ floatImage.sizeModifier }})</label>
        <input id="size" type="range" min="-.85" max="1.5" step=".01" v-model="floatImage.sizeModifier">
      </div>
    </section>
    <case-study :headline="headline"
                :summary="summary"
                :textColor="textColor"
                :cta="cta"
                :logo="logo"
                :background="background"
                :floatImage="floatImage">
    </case-study>
  </main>
</template>

<script>
import caseStudy from '../../components/case-study.vue';

export default {
  name: 'caseStudy',
  components: {
    'case-study': caseStudy
  },
  data() {
    return {
      headline: 'Lorem Ipsum Dolor Sit Amet Consectetur',
      summary: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna',
      textColor: 'light',
      cta: {
        title: 'Read More',
        type: 'secondary',
        href: '/case-studies/example'
      },
      logo: {
        href: '/wp-content/themes/wpvue/images/branding/logo.svg',
        alt: ''
      },
      background: 'https://placeimg.com/1000/400',
      floatImage: {
        href: '/wp-content/themes/wpvue/images/style-guide/mid-ic-pneumatic.png',
        alt: 'Rando Image',
        offset: {
          bottom: 15,
          right: -20
        },
        sizeModifier: 1
      }
    }
  },
  methods: {
    toggleBtnType() {
      if (this.cta.type === 'primary') {
        this.cta.type = 'secondary';
      } else {
        this.cta.type = 'primary';
      }
    },
    toggleTemp() {
      if (this.textColor === 'light') {
        this.textColor = 'dark';
      } else {
        this.textColor = 'light';
      }
    }
  }
}
</script>

<style lang="scss">
  .case-study__toggle-label {
    display: block;
    font-size: .875rem;
    font-weight: bold;
  }
  .case-study-sizers {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-around;

    >*:nth-child(2), >*:nth-child(3) {
      flex: 1 0 50%;
    }
    >*:nth-child(n + 3) {
      flex: 1 0 calc(33.33% - 40px);
      margin: 20px;
    }
  }
</style>
