<template>
  <div class="content">
    <h1 align="center" class="primary--text">Cadastrando aluno</h1>
    <FormStudent />
  </div>
</template>

<script>
import FormStudent from "./Form";

export default {
  name: "CreateStudent",
  components: {
    FormStudent,
  },
};
</script>
