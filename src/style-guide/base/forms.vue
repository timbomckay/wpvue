<template>
  <main class="container slim-container">
    <h2>Forms</h2>
    <p>
      Input field of type 'url', 'text', 'tel', 'time', 'search', 'password', 'email', and 'textarea' use a base
      Vue component <code>&lt;base-input&gt;</code>. This component contains all the markup
      (<code>.form-group</code>, <code>label</code>, etc...) and javascript for the label positioning.
    </p>
    <p>The props are <code>name</code>,
                     <code>type</code> (default: text),
                     <code>required</code> ('true' or 'false'),
                     <code>labelText</code> (required), and
                     <code>white</code> (for white text)
    </p>
    <section>
      <form>
        <div class="row">
          <div class="col-md">
            <base-input name="name1" type="text" required="true" labelText="Name"></base-input>
          </div>
          <div class="col-md">
            <base-input type="text" labelText="Company" required="true"></base-input>
          </div>
        </div>
        <base-input name="email" type='email' labelText="Email" required="true"></base-input>
        <div class="row">
          <div class="col-md-6">
            <select name="">
              <option value="1">How Can We Help</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
              <option value="4">Option 4</option>
              <option value="5">Option 5</option>
              <option value="6">Option 6</option>
            </select>
          </div>
        </div>
        <base-input type='textarea' labelText="Message"></base-input>
        <div class="form-group py-2">
          <div class="form-check--inline">
            <input class="form-check__input" type="checkbox" value="" id="defaultCheck1">
            <label class="form-check__label" for="defaultCheck1">
              Sign me up for the newsletter!
            </label>
          </div>
        </div>
        <input class="block-right" type="submit" value="Let's Do This">
      </form>
    </section>
  </main>
</template>
<script>
import baseInput from '../../elements/base-input.vue';

  export default {
    name: 'sg-forms',
    components: {
      'base-input': baseInput
    },
    data () {
      return {
        name: '',
        company: '',
        email: '',
        message: '',
        checkboxes: ['one', 'two', 'three'],
        radios: ['one', 'two', 'three']
      }
    }
  };
</script>
<style lang="less">

</style>
