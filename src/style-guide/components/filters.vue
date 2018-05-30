<template>
  <main class="slim-container">
    <h2>Filters</h2>
    <p>Filters (<code>&lt;filter-toggle&gt;</code>) have one required prop: <code>filters[]</code>
      which should contain objects with a <code>name</code> and <code>id</code>. The first will be selected by default.
      So, in this example the first object is <code>{name: 'All Categories', id: '1'}</code>.
    </p>
    <p>
      Note: The event for triggering a category filtering has not been set up yet. The filter will pass the id
      of the selected category through a custom event.
    </p>
    <filter-toggle :filters="mock.filters"></filter-toggle>
  </main>
</template>

<script>
import filterToggle from '../../components/filter-toggle.vue';

export default {
  name: 'filters',
  components: {
    'filter-toggle': filterToggle
  },
  data() {
    return {
      mock: {
        title: 'All Categories',
        filters: [
          {
            name: 'All Categories',
            id: '0'
          },
          {
            name: 'I am a category',
            id: '1'
          },
          {
            name: 'So am I',
            id: '2'
          },
          {
            name: 'Me too me too',
            id: '3'
          },
          {
            name: 'Category 4',
            id: '4'
          }
        ]
      }
    }
  }
}
</script>

<style lang="css">
</style>
