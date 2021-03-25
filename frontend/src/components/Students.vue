<template>
  <v-data-table
    :headers="headers"
    :items="registeredStudents"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Studants</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              New Student
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>
            <v-col sm="12">
              <v-list>
                <v-list-item v-for="(error,index) in errors" :key="index">
                  <v-alert v-if="responseError" dense text type="error">
                    {{ error[0] }}
                  </v-alert>
                </v-list-item>
              </v-list>
            </v-col>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                  >
                    <v-text-field
                      v-model="editedItem.name"
                      label="Name"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                  >
                    <v-text-field
                      v-model="editedItem.email"
                      label="Email"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                  >
                    <v-text-field
                      v-model="editedItem.cpf"
                      label="CPF"
                      required
                      min-length=11
                      max-length=14
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                  >
                    <v-text-field
                      v-model="editedItem.ra"
                      label="RA"
                      max-length=20
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="headline">Are you sure you want to delete this student?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
  </v-data-table>
</template>
<script>
import api from "@/service/apiService";

export default {
  name: "Student",
  data() {
    return {
      dialog: false,
      dialogDelete: false,
      studentRegistration: {
        name: "",
        email: "",
        cpf: "",
        ra: "",
      },
      headers: [
        {
          text: 'ID',
          align: 'start',
          sortable: false,
          value: 'id',
        },
        { text: 'Name', value: 'name' },
        { text: 'E-mail', value: 'email' },
        { text: 'CPF', value: 'cpf' },
        { text: 'RA', value: 'ra' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      registeredStudents: [],
      responseSuccess: false,
      responseError: false,
      errors: [],
      editedIndex: -1,
      editedItem: {
        name: '',
        email: '',
        cpf: '',
        ra: '',
      },
      defaultItem: {
        name: '',
        email: '',
        cpf: '',
        ra: '',
      },
    }
  },
  
  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'New Student' : 'Edit Student'
    },
  },

  watch: {
    dialog (val) {
      val || this.close()
    },
    dialogDelete (val) {
      val || this.closeDelete()
    },
  },

  created () {
    this.initialize()
  },

  methods: {
    initialize: async function() {
        const data = await api.readStudents();
        this.registeredStudents = data.data;
    },

    editItem (item) {
      this.editedIndex = this.registeredStudents.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
      this.responseError = false;
      },

    deleteItem (item) {
      this.editedIndex = this.registeredStudents.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialogDelete = true
    },

    deleteItemConfirm : async function() {
      await api.deleteStudent(this.editedItem.id)
          .then(response => {
              this.responseError = false;
              this.initialize()
              this.close()
          })
          .catch(error => {
            this.responseError = true;
            this.errors = error.response.data.errors
            
          })
      
      this.closeDelete()
    },

    close () {
      this.dialog = false
      this.responseError = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    closeDelete () {
      this.dialogDelete = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    save: async function() {
            
      if (this.editedIndex > -1) {
        await api.updateStudent(this.editedItem.id, this.editedItem)
          .then(response => {
              this.responseError = false;
              this.initialize()
              this.close()
              console.log(response.data);
          })
          .catch(error => {
            this.responseError = true;
            this.errors = error.response.data.errors
            
          })
        //Object.assign(this.registeredStudents[this.editedIndex], this.editedItem)

      } else {
        await api.createStudent(this.editedItem)
          .then(response => {
              this.responseError = false;
              this.initialize()
              this.close()
              console.log(response.data);
          })
          .catch(error => {
            this.responseError = true;
            this.errors = error.response.data.errors
            
          })
        //this.registeredStudents.push(this.editedItem)
      }
    },
  },
}
</script>
  