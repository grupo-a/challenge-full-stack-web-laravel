<template>
  <div class="content">
    <v-container>
      <v-row align="center">
        <v-text-field
          class="pt-6"
          dense
          outlined
          placeholder="Digite sua busca"
          label="Pesquisa"
          v-model="searchTerm"
          :loading="loading"
          clearable
          v-on:keyup.enter="handleSearch"
        ></v-text-field>
        <v-btn class="ml-4" v-on:click="handleSearch" color="primary">
          Buscar
        </v-btn>
      </v-row>
    </v-container>
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