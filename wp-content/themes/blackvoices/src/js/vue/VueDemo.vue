<template>
  <div class="vue-demo">
    <div class="container">
      <h1>{{ title }}</h1>
    </div>
  </div>
</template>

<script>
export default {
  props: ['title', 'filters'],

  data() {
    return {
      results: [],
    };
  },

  mounted() {
    this.sampleMethod();
  },

  updated() {},

  methods: {
    /**
     * Reset all selected filters.
     */
    sampleMethod() {
      console.log('sample method')
    }
  },

  computed: {}
};
</script>
