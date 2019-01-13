<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Cursos</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" color="primary" dark class="mb-2">Nuevo Curso</v-btn>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout>
                <v-text-field v-model="editedItem.codigo" label="Codigo"></v-text-field>
              </v-layout>
              <v-layout>
                <v-text-field v-model="editedItem.nombre" label="Nombre"></v-text-field>
              </v-layout>
              <v-layout>
                <v-text-field v-model="editedItem.semestre" label="Semestre" readonly></v-text-field>
              </v-layout>
              <v-layout>
                <v-select
                  item-value="id"
                  item-text="nombre"
                  :items="carreras"
                  label="Carrera"
                  v-model="editedItem.carrera_id"
                ></v-select>
              </v-layout>
              <v-layout>
                <v-text-field v-model="editedItem.creditos" label="Creditos"></v-text-field>
              </v-layout>
              <v-layout>
                <v-text-field v-model="editedItem.h_presencial" label="Horas Presenciales"></v-text-field>
              </v-layout>
              <v-layout>
                <v-text-field v-model="editedItem.h_autonomas" label="Horas Autonomas"></v-text-field>
              </v-layout>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click.native="close">Cancelar</v-btn>
            <v-btn color="blue darken-1" flat @click.native="save">Guardar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-data-table :headers="headers" :items="cursos" hide-actions class="elevation-1">
      <template slot="items" slot-scope="props">
        <td>{{ props.item.codigo }}</td>
        <td class="text-xs-right">{{ props.item.nombre }}</td>
        <td class="text-xs-right">{{ props.item.semestre }}</td>
        <td class="text-xs-right">{{ props.item.carrera_id }}</td>
        <td class="text-xs-right">{{ props.item.creditos }}</td>
        <td class="text-xs-right">{{ props.item.estado }}</td>
        <td class="justify-center align-center layout px-0">
          <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
          <v-icon small @click="deleteItem(props.item)">delete</v-icon>
        </td>
      </template>
      <template slot="no-data">Sin Elementos</template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    headers: [
      { text: "Codigo", align: "left", value: "codigo" },
      { text: "Nombre", value: "nombre" },
      { text: "Semestre", value: "semestre" },
      { text: "Carrera", value: "carrera_id" },
      { text: "Creditos", value: "creditos" },
      { text: "Estado", value: "estado" },
      { text: "Actions", value: "codigo", sortable: false }
    ],
    cursos: [],
    carreras: [],
    editedIndex: -1,
    editedItem: {
      codigo: "",
      nombre: "",
      semestre: "",
      carrera_id: "",
      creditos: "",
      h_presencial: "",
      h_autonomas: "",
      estado: ""
    },
    defaultItem: {
      codigo: "",
      nombre: "",
      semestre: "",
      carrera_id: "",
      creditos: "",
      h_presencial: "",
      h_autonomas: "",
      estado: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo Curso" : "Editar Curso";
    },
    semestre() {
      var año = new Date().toISOString().substr(0, 4);
      var mes = new Date().toISOString().substr(5, 2);
      if (mes > 6) return año + "-2";
      else return año + "-1";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.cargarCursos();
      this.defaultItem.semestre = this.semestre;
      this.editedItem.semestre = this.semestre;
      this.cargarCarrera();
    },

    editItem(item) {
      this.editedIndex = this.cursos.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const id = item.id;
      confirm("Estas seguro de querer eliminar este curso?") &&
        this.eliminarCursos(id);
      this.cargarCursos();
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        this.actualizarCursos();
      } else {
        this.guardarCursos();
      }
      this.cargarCursos();
      this.close();
    },
    cargarCursos() {
      var url = "/cursos";
      axios.get(url).then(response => {
        this.cursos = response.data;
      });
    },
    guardarCursos() {
      var url = "/carrera/" + this.editedItem.carrera_id + "/curso/store";
      axios
        .post(url, {
          codigo: this.editedItem.codigo,
          nombre: this.editedItem.nombre,
          semestre: this.editedItem.semestre,
          carrera_id: this.editedItem.carrera_id,
          creditos: this.editedItem.creditos,
          h_presencial: this.editedItem.h_presencial,
          h_autonomas: this.editedItem.h_autonomas,
          estado: this.editedItem.estado
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizarCursos() {
      var url = "/curso/" + this.editedItem.id + "/update";
      axios
        .put(url, {
          codigo: this.editedItem.codigo,
          nombre: this.editedItem.nombre,
          semestre: this.editedItem.semestre,
          carrera_id: this.editedItem.carrera_id,
          creditos: this.editedItem.creditos,
          h_presencial: this.editedItem.h_presencial,
          h_autonomas: this.editedItem.h_autonomas,
          estado: this.editedItem.estado
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminarCursos(id) {
      var url = "/curso/" + id + "/delete";
      axios
        .delete(url)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cargarCarrera() {
      var url = "/carreras";
      axios.get(url).then(response => {
        this.carreras = response.data;
      });
    }
  }
};
</script>
