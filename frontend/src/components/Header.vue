<template>
  <div class="content">
    <v-toolbar dense color="secondary">
      <v-toolbar-items class="py-2">
        <v-btn class="mr-2 rounded-lg" to="/" color="primary">Home</v-btn>        
        <v-btn class="rounded-lg" to="/student" color="primary">Alunos</v-btn>
      </v-toolbar-items>
    </v-toolbar>    
  </div>
</template>

<script>
export default {
  name: "Header",
};
</script>

<style scoped>
 nav li:hover,
 nav li.router-link-active,
 nav li.router-link-exact-active {
   background-color: indianred;
   cursor: pointer;
 }
</style>