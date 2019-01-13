<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Facultades</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" color="primary" dark class="mb-2">Nueva Facultad</v-btn>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.nombre" label="Nombre"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field v-model="editedItem.descripcion" label="Descripcion"></v-text-field>
                </v-flex>
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
      :items="facultades"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.nombre }}</td>
        <td class="text-xs-right">{{ props.item.descripcion }}</td>
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
      { text: "Descripcion", value: "descripcion", sortable: false },
      { text: "Actions", value: "name", sortable: false }
    ],
    facultades: [],
    editedIndex: -1,
    editedItem: {
      nombre: "",
      descripcion: ""
    },
    defaultItem: {
      nombre: "",
      descripcion: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nueva Facultad" : "Editar Facultad";
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
      this.cargarFacultades();
    },

    editItem(item) {
      this.editedIndex = this.facultades.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const id = item.id;
      confirm("Estas seguro de querer eliminar esta facultad?") &&
        this.eliminarFacultades(id);
      this.cargarFacultades();
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
        this.actualizarfacultades();
      } else {
        this.guardarFacultades();
      }
      this.cargarFacultades();
      this.close();
    },
    cargarFacultades() {
      var url = "/facultades";
      axios.get(url).then(response => {
        this.facultades = response.data;
      });
    },
    guardarFacultades() {
      var url = "/facultades/store";
      axios
        .post(url, {
          nombre: this.editedItem.nombre,
          descripcion: this.editedItem.descripcion
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizarfacultades() {
      var url = "/facultades/" + this.editedItem.id + "/update";
      axios
        .put(url, {
          nombre: this.editedItem.nombre,
          descripcion: this.editedItem.descripcion
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminarFacultades(id) {
      var url = "/facultades/" + id + "/delete";
      axios
        .delete(url)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
