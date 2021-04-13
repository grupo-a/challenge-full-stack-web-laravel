<template>
  <div class="content">
    <div class="header">
      <Search :onSearch="handleSearch" />
      <Button route="create" caption="Adicionar"/>
    </div>
    <div class="student-data">
      <v-container>
        <v-row v-for="student in filteredStudents" :key="student.id">
          <v-col> {{ student.id }} </v-col>
          <v-col> {{ student.name }} </v-col>
          <v-col> {{ student.cpf }} </v-col>
          <v-col> {{ student.email }} </v-col>
          <v-col> {{ student.academic_register }} </v-col>
          <v-col>
            <v-btn v-on:click="handleDelete(student.id)">
              Excluir
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>

<script>
import api from "@/services/api";
import Search from "@/components/Search";
import Button from "@/components/Button";

export default {
  name: "Student",
  components: {
    Search,
    Button,
  },
  data() {
    return {
      students: [],
      searchTerm: null,
      filteredStudents: this.students,
    };
  },
  mounted() {
    api
      .get("/students")
      .then((response) => (this.students = response.data.data));
  },
  watch: {
    students: function (val) {
      this.filteredStudents = val;
    },
    searchTerm: function (val) {
      if (val == "") {
        this.filteredStudents = this.students;
        return;
      }

      this.filteredStudents = this.students.filter((student) => {
        return (
          student.name.includes(val) ||
          student.cpf.includes(val) ||
          student.email.includes(val) ||
          student.academic_register.includes(val)
        );
      });
    },
  },
  methods: {
    handleSearch(searchTerm) {
      this.searchTerm = searchTerm;
    },
    handleDelete(id){
      this.$confirm("Deseja excluir o aluno?").then(() => {
        api.delete(`/students/${id}`)
        .then((response) => {
          if (response.status == 204){
            this.students = this.students.filter((student) => student.id != id);
            this.$alert("Aluno excluído com sucesso.");
          }
        })
        .catch(() => {
          this.$alert("Ocorreu um erro inesperado.");
        });
      });
    }
  },
};
</script>
