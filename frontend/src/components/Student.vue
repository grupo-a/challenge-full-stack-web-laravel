<template>
  <div class="content">
    <div class="student-data">
      <v-container>
        <v-row v-for="student in students" :key="student.id">
          <v-col> {{ student.name }} </v-col>
          <v-col> {{ student.cpf }} </v-col>
          <v-col> {{ student.email }} </v-col>
          <v-col> {{ student.academic_register }} </v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>

<script>
import api from "../services/api";

export default {
  name: "Student",
  data() {
    return {
      students: [],
    };
  },
  mounted() {
    api
      .get("/students")
      .then((response) => (this.students = response.data.data));
  },
};
</script>