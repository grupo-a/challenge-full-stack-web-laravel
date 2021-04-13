<template>
  <div class="content">
    <v-form
      ref="form"
    >
      <v-container>
        <v-row>
          <v-col
            cols="12"
          >
            <v-text-field
              outlined
              v-model="name"
              :rules="nameRules"
              placeholder="Informe o nome completo"
              label="Nome"
              counter=200
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
          >
            <v-text-field
              outlined
              v-model="email"
              :rules="emailRules"
              placeholder="Informe apenas um e-mail"
              label="E-mail"
              counter=100
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
          >
            <v-text-field
              outlined
              v-model="academic_register"
              :rules="academicRegisterRules"
              placeholder="Informe o registro acadêmico"
              label="Registro Acadêmico"
              counter=40
            ></v-text-field>
          </v-col>

          <v-col
            cols="12"
          >
            <v-text-field
              outlined
              v-model="cpf"
              :rules="cpfRules"
              placeholder="Informe o número do documento"
              label="CPF"
              counter=11
            ></v-text-field>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
    <Button route="/student" caption="Cancelar"/>
    <v-btn v-on:click="handleSubmit">Salvar</v-btn>
  </div>
</template>

<script>

import Button from '@/components/Button.vue';
import api from "@/services/api";

export default {
  name: "FormStudent",
  components: {
    Button
  },
  data() {
    return {
      name: "",
      email: "",
      academic_register: "",
      cpf: "",
      nameRules: [
        v => !!v || 'Informe o nome completo',
        v => v.length >= 10 || 'O nome precisa ter no mínimo 10 caracteres',
      ],

      emailRules: [
        v => !!v || 'Informe o e-mail',
        v => /.+@.+/.test(v) || 'Informe um e-mail válido',
      ],

      academicRegisterRules: [
        v => !!v || 'Informe o registro acadêmico',
      ],

      cpfRules: [
        v => !!v || 'Informe o CPF',
        v => /[0-9]{11}/.test(v) || 'O CPF deve conter 11 dígitos, somente números'
      ]
    };
  },
  methods:{
    validate () {
      return this.$refs.form.validate();
    },
    handleSubmit(){
      if (!this.validate()){
        return;
      }

      api.post(
        "/students",
        {
          "name": this.name,
          "cpf": this.cpf,
          "academic_register": this.academic_register,
          "email": this.email
        }
      )
      .then((response) => {
        if (response.status == 201){
          this.$router.replace('/student');
          this.$alert("Aluno incluído com sucesso.");
        }
      })
      .catch(() => {
        this.$alert("Ocorreu um erro inesperado.");
      });
    }
  }
};

</script>
