<template>
  <div class="content">
    <v-text-field v-model="searchTerm" :loading="loading"></v-text-field>
    <v-btn v-on:click="handleSearch"> Buscar </v-btn>
  </div>
</template>

<script>
export default {
  props: ["onSearch"],
  data() {
    return {
      loading: false,
      searchTerm: null,
    };
  },
  monted() {
    this.s = this.searchTerm;
  },
  methods: {
    handleSearch() {
      this.loading = true;
      try {
        this.onSearch(this.searchTerm);
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>