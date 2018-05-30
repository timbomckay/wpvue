<template>
  <footer class="footer" :class="classList">
    <div class="container py-15">
        <ul class="footer-nav">
          <li class="d-none d-md-block"><a href="" class="nav-link">Work</a></li>
          <li class="d-none d-md-block"><a href="" class="nav-link">Process</a></li>
          <li class="d-none d-md-block"><a href="" class="nav-link">Team</a></li>
          <li class="d-none d-md-block"><a href="" class="nav-link">Services</a></li>
          <li><a href="" class="nav-link">Awards</a></li>
          <li><a href="" class="nav-link">Blog</a></li>
          <li><a href="" class="nav-link">Contact Us</a></li>
        </ul>
        <div class="footer__content">
          <span class="footer__legal"><icon href="logo-symbol" class="fs-xl mr-05"></icon>A division of<icon href="adk" class="fs-xl mx-05"></icon></span>
          <span class="footer__legal"><a href="#">© 2018 Terms of Use</a> | <a href="#">Privacy Policy</a></span>
          <span class="footer__legal"><icon href="location" class="mx-05"></icon>607 W. Main Street, Suite 500, 40202</span>
          <socialBar></socialBar>
        </div>
    </div>
  </footer>
</template>

<script>
  import socialBar from "../modules/social-bar.vue";

  export default {
    name: 'bsmfooter',
    components: {
      socialBar
    }
  }
</script>

<style lang="less">
  @import "../utils/variables.less";
  @import "../utils/breakpoints.less";

  .footer {
    background-color: @color-blackout-dark;

    &__content {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      color: #fff;
      font-family: 'PT Sans', Tahoma, Geneva, sans-serif;
      color: #fff;
      letter-spacing: 0.5px;
      font-size: 1rem;
      line-height: 0.8421052632;

      .icon {
        vertical-align: middle;
      }

      @media @extra-large {
        flex-direction: row;
      }
    }

    &__legal {
      display: block;
      margin: 0.6rem 0;
      &:last-of-type {
        flex: 1;
      }
    }
    a {
      color: #fff;
      font-weight: normal;
      &:hover {
        color: #fff;
        &:after {
          color: #fff;
        }
      }
    }
    .icon {
      color: #fff;
    }

    .footer-nav {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      padding-left: 0;
      margin-bottom: 5px;
      list-style: none;
      @media @extra-large {
        justify-content: left;
      }

      li {
        margin: 0 1rem 0 0;
      }
      .nav-link {
        font-size: 1.25rem;
      }
    }
  }
</style>
