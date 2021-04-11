<template>
  <div class="content">
    <ul>
      <li><router-link to="/">Home</router-link></li>
      <li><router-link to="/student">Alunos</router-link></li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "Header",
};
</script>