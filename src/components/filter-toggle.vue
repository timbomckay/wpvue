<template>
  <div class="filter" :class="{open: filterOpen}">
    <a class="filter__heading" tabindex="0" @click='filterOpen = !filterOpen'>{{ selectedFilter.name }}</a>
    <div class="filter__container">
      <ul>
        <li class="h4 filter__category" v-for="(filter, i) in filters" :class="{'filter__category--active': (filter.id === selectedFilter.id)}" :key="i">
          <span @click="toggleFilter($event, i)">{{ filter.name }}</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: 'filter-toggle',
  props: {
    title: {
      type: String,
      required: true
    },
    filters: {
      type: Array,
      required: true,
      validator: value => {
        let valid = true;
        for (var i = 0; i < value.length; i++) {
          if (!(("name" in value[i]) && ("id" in value[i])))
            valid = false;
        }
        return valid;
      }
    }
  },
  data() {
    return {
      selectedFilter: this.filters[0],
      filterOpen: false
    }
  },
  methods: {
    toggleFilter(e, i) {
      this.selectedFilter = this.filters[i];
      this.filterOpen = false;
    }
  }
}
</script>

<style lang="less">
@import '../utils/variables';
@import '../utils/helper-other';
@import '../utils/breakpoints';
@import '../utils/mixins';

@filterMaxWidth: 21.5rem;

.filter {

  &__heading {
    color: @color-cobalt;
    font-size: 1.125rem;
    line-height: 1.8;
    border: 4px solid @color-cobalt;
    @caret-right-down();
    max-width: @filterMaxWidth;
    width: 100%;
    justify-content: center;

    &:after {
      font-size: 2rem;
      margin-left: 1rem;
      line-height: .5;
      margin-top: -.25rem;
    }
  }
  &__container {
    .shadow-2;
    max-width: @filterMaxWidth;
    padding: 1.5rem .5rem;
    ul { list-style: none }
    .transition(transform);
    transform-origin: top;
    transform: scaleY(0);

    .filter.open & {
      transform: scaleY(1);
    }
  }

  &__category {
    span:hover, &--active, &:focus {
      color: @color-cobalt;
      cursor: pointer;
    }
  }
}

</style>
