<template>
    <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Carreras</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" color="primary" dark class="mb-2">Nueva carrera</v-btn>
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
                  <v-text-field v-model="editedItem.total_creditos" label="Total Creditos"></v-text-field>
                </v-layout>
                <v-layout>
                  <v-select item-value="id" item-text="nombre" :items="facultades" label="Facultad" v-model="editedItem.facultad_id"></v-select>
                </v-layout>
                <v-layout>
                  <v-select item-value="id" item-text="nombre" :items="directores" label="Director" v-model="editedItem.user_id"></v-select>
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
    <v-data-table
      :headers="headers"
      :items="carreras"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.nombre }}</td>
        <td class="text-xs-right">{{ props.item.codigo }}</td>
        <td class="text-xs-right">{{ props.item.total_creditos }}</td>
        <td class="text-xs-right">{{ props.item.facultad_id}}</td>
        <td class="text-xs-right">{{ props.item.user_id }}</td>
        <td class="justify-center align-center layout px-0">
          <v-icon
            small
            class="mr-2"
            @click="editItem(props.item)"
          >
            edit
          </v-icon>
          <v-icon
            small
            @click="deleteItem(props.item)"
          >
            delete
          </v-icon>
        </td>
      </template>
      <template slot="no-data">
        Sin Elementos
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    headers: [
      { text: "Nombre", align: "left", value: "nombre" },
      { text: "Codigo", value: "codigo" },
      { text: "Total Creditos", value: "total_creditos" },
      { text: "Facultad", value: "facultad_id" },
      { text: "Director", value: "user_id" },
      { text: "Actions", value: "name", sortable: false }
    ],
    carreras: [],
    directores: [],
    facultades: [],

    editedIndex: -1,
    editedItem: {
      id: 0,
      nombre: "",
      codigo: "",
      facultad_id: "",
      total_creditos: "",
      user_id: ""
    },
    defaultItem: {
      id: 0,
      nombre: "",
      codigo: "",
      facultad_id: "",
      total_creditos: "",
      user_id: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nueva Carrera" : "Editar Carrera";
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
      this.cargarCarreras();
      this.cargarDirectores();
      this.cargarfacultades();
    },

    editItem(item) {
      this.editedIndex = this.carreras.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const id = item.id;
      confirm("Estas seguro de querer eliminar esta carrera?") &&
        this.eliminarCarrera(id);
      this.cargarCarreras();
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
        this.actualizarCarrera();
      } else {
        this.guardarCarreras();
      }
      this.cargarCarreras();
      this.close();
    },
    cargarCarreras() {
      var url = "/carreras";
      axios.get(url).then(response => {
        this.carreras = response.data;
      });
    },
    guardarCarreras() {
      var url = "/facultades/" + this.editedItem.facultad_id + "/carrera/store";
      axios
        .post(url, {
          nombre: this.editedItem.nombre,
          codigo: this.editedItem.codigo,
          total_creditos: this.editedItem.total_creditos,
          user_id: this.editedItem.user_id
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizarCarrera() {
      var url = "/carrera/" + this.editedItem.id + "/update";
      axios
        .put(url, {
          nombre: this.editedItem.nombre,
          codigo: this.editedItem.codigo,
          facultad_id: this.editedItem.facultad_id,
          total_creditos: this.editedItem.total_creditos,
          user_id: this.editedItem.user_id
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminarCarrera(id) {
      var url = "/carrera/" + id + "/delete";
      axios
        .delete(url)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cargarDirectores() {
      var url = "/usuarios/directores";
      axios.get(url).then(response => {
        this.directores = response.data;
      });
    },
    cargarfacultades() {
      var url = "/facultades";
      axios.get(url).then(response => {
        this.facultades = response.data;
      });
    }
  }
};
</script>
