<template>
  <div class="form-group" :class="{'form-group--white': white}">
    <textarea v-if="type === 'textarea'" :id="name" rows="1" @input='autoHeight($event)' @blur='positionLabel($event)'></textarea>
    <input v-else :id="name" :type="type" :required='required' @blur='positionLabel($event)'>
    <label class='float-label' :for="name">{{ labelText }}</label>
    <span class="required" v-if="required == 'true'">Required</span>
  </div>
</template>

<script>
export default {
  name: 'base-input',
  props: {
    name: {
      type: String,
      default: () => {
        return `input-${(Math.random() * 100000).toFixed(0)}`;
      }
    },
    type: {
      type: String,
      default: 'text',
      validator: v => {
        return ['url', 'text', 'tel', 'time', 'search', 'password', 'email', 'textarea'].indexOf(v) > -1;
      }
    },
    required: {
      type: Boolean,
      default: false
    },
    labelText: {
      type: String,
      required: true
    },
    white: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      textareaHeight: ''
    }
  },
  methods: {
    positionLabel(e) {
      if (e.target.value !== '') {
        e.target.classList.add('filled');
      } else {
        e.target.classList.remove('filled');
      }
    },
    autoHeight(e) {
      if (this.textareaHeight === '') {
        this.textareaHeight = e.target.scrollHeight
      } else {
        if (e.target.scrollHeight > this.textareaHeight) {
          e.target.rows = (e.target.rows + 1);
          this.textareaHeight = e.target.scrollHeight;
        } else {
          this.textareaHeight = e.target.scrollHeight;
        }
      }
    }
  }
}

var textareas = document.querySelectorAll('textarea');
var textareasObj = {};
if (textareas.length) { textareas.forEach(initTextareaAutoheight); }

function initTextareaAutoheight(item, index) {
  textareasObj[index] = {
    height: item.scrollHeight
  }
  item.addEventListener('input', function() {
    if (this.scrollHeight > textareasObj[index].height) {
      this.rows = (this.rows + 1);
      textareasObj[index].height = this.scrollHeight;
    } else {
      textareasObj[index].height = this.scrollHeight;
    }
  })
}

/* See forms.less for styles */

</script>
