<template>
  <div class="content">    
    <h1 align="center" class="primary--text">Editando aluno</h1>
    <FormStudent :student_id=this.$route.params.id></FormStudent>
  </div>
</template>

<script>

import FormStudent from "./Form";

export default {
  name: "EditStudent",
  components: {
    FormStudent
  },
};
</script>
