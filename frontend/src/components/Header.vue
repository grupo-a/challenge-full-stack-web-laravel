<template>
  <div class="content">
    <v-toolbar dense color="primary">
      <v-toolbar-items class="py-2">
        <v-btn class="mr-2 rounded-lg" to="/" color="secondary">Home</v-btn>        
        <v-btn class="rounded-lg" to="/student" color="secondary">Alunos</v-btn>
      </v-toolbar-items>
    </v-toolbar>    
  </div>
</template>

<script>
export default {
  name: "Header",
};
</script>