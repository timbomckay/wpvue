<template>
  <div class="case-study" :class="{'case-study--dark': textColor === 'light'}" :style="`background-image: url(${background})`">
    <h2>{{ headline }}</h2>
    <p>{{ summary }}</p>
    <a :href="cta.href" :class="`btn btn-sm btn-${cta.type}`">{{ cta.title }}</a>
    <img class="case-study__logo" :src="logo.href" :alt='logo.alt'/>
    <img class="case-study__float-img" :src="floatImage.href" :alt="floatImage.alt"
      :style="`transform: translate(${floatImage.offset.right}%, ${floatImage.offset.bottom}%) scale(${floatImage.sizeModifier})`">
  </div>
</template>

<script>
export default {
  name: 'case-study',
  props: {
    headline: {
      type: String,
      required: true
    },
    summary: {
      type: String,
      required: true
    },
    textColor: {
      type: String,
      default: () => {
        return 'dark'
      }
    },
    cta: {
      type: Object,
      required: true,
      validator: value => {
        return (("title" in value) && ("type" in value) && ("href" in value));
      }
    },
    logo: {
      type: Object,
      validator: value => {
        return (("href" in value) && ("alt" in value));
      }
    },
    background: {
      type: String,
      required: true
    },
    floatImage: {
      type: Object,
      required: false,
      validator: value => {
        return (("href" in value) && ("alt" in value) && ("offset" in value));
      }
    }
  },
}
</script>

<style lang="less">
@import '../utils/breakpoints';

.case-study {
  padding: 1rem;
  height: 400px;
  position: relative;
  background-size: cover;
  background-repeat: no-repeat;

  @media @medium {
    padding: 2rem;
  }

  &--dark {
    h2, p { color: #fff }
  }

  h2 {
    width: 100%;
    max-width: 27.5rem;
    line-height: 1.111111;
    margin-bottom: 1rem;
    margin-top: 2rem;
    @media @medium {
      width: 40%;
      margin-top: 0;
    }
  }

  p {
    display: none;
    width: 40%;
    max-width: 27.5rem;
    @media @medium {
      display: block;
    }
  }

  &__logo {
    position: absolute;
    left: 1rem;
    top: 1rem;
    height: 2rem;
    width: 10rem;

    @media @medium {
      top: 2rem;
      left: auto;
      right: 2rem;
      height: auto;
    }
  }

  &__float-img {
    position: absolute;
    height: 50%;
    width: auto;
    bottom: 0;
    right: 0;

    @media @small {
      height: 65%;
    }
    @media @medium {
      height: 80%;
    }
    @media @large {
      height: 100%;
    }
  }

  .btn {
    margin: 0;
  }
}

</style>
