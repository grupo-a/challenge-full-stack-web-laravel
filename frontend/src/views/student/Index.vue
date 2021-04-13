<template>
  <div class="content">
    <div class="header">
      <v-container>
        <v-row align="center">
          <v-col cols="9">          
            <Search :onSearch="handleSearch"/>
          </v-col>
          <v-col cols="3">
            <v-btn to="create" color="primary" class="rounded-lg" append>Cadastrar Aluno</v-btn>
          </v-col>
        </v-row>     
      </v-container> 
    </div>
    <div class="student-data">
      <v-data-table
        dense
        :headers="headers"
        :items="filteredStudents"
        item-key="id"
        class="elevation-1"
      >
        <template v-slot:item="row">
            <tr>
              <td>{{row.item.academic_register}}</td>
              <td>{{row.item.name}}</td>
              <td align="center">{{formatCPF(row.item.cpf)}}</td>
              <td align="center">
                <v-btn class="mx-2" fab dark small color="error" @click="handleDelete(row.item.id)">
                    <v-icon dark>mdi-delete</v-icon>
                </v-btn>              
                <v-btn class="mx-2" fab dark small color="primary" :to="'edit/' + row.item.id" append>                
                  <v-icon dark>mdi-circle-edit-outline</v-icon>
                </v-btn>
              </td>
            </tr>
        </template>
      </v-data-table>      
    </div>
  </div>
</template>

<script>
import api from "@/services/api";
import Search from "@/components/Search";

export default {
  name: "Student",
  components: {
    Search,
  },
  data() {
    return {
      students: [],
      searchTerm: null,
      filteredStudents: this.students,
      headers: [
        { text: 'Registro Acadêmico'},
        { text: 'Nome'},
        { text: 'CPF', align: 'center'},
        { text: 'Ações', sortable: false, align: 'center'},
      ],
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
    handleDelete(id) {
      this.$confirm("Deseja excluir o aluno?").then(() => {
        api
          .delete(`/students/${id}`)
          .then((response) => {
            if (response.status == 204) {
              this.students = this.students.filter(
                (student) => student.id != id
              );
              this.$alert("Aluno excluído com sucesso.");
            }
          })
          .catch(() => {
            this.$alert("Ocorreu um erro inesperado.");
          });
      });
    },
    formatCPF(cpf){
      return cpf.substr(0,3) + "." +
      cpf.substr(3,3) + "." +
      cpf.substr(6,3)+ "-" +
      cpf.substr(9,2);
    }
  },
};
</script>
