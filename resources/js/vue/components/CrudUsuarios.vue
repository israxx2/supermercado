<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Usuarios</v-toolbar-title>
      <v-divider
        class="mx-2"
        inset
        vertical
      ></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" color="primary" dark class="mb-2">Nuevo Usuario</v-btn>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
                <v-layout>
                  <v-text-field v-model="editedItem.nombre" label="Nombre"></v-text-field>
                </v-layout>
                <v-layout>
                  <v-text-field v-model="editedItem.apellido" label="Apellido"></v-text-field>
                </v-layout>
                <v-layout>
                  <v-text-field v-model="editedItem.email" label="Email"></v-text-field>
                </v-layout>
                <v-layout>
                  <v-text-field v-model="editedItem.password" label="password"></v-text-field>
                </v-layout>
                <v-layout>
                  <v-select :items="tipos" label="Tipo" v-model="editedItem.tipo"></v-select>
                </v-layout>
                <v-layout>
                  <v-text-field v-model="editedItem.telefono" label="Telefono"></v-text-field>
                </v-layout>
                <v-layout>
                  <v-text-field v-model="editedItem.rut" label="Rut"></v-text-field>
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
      :items="usuarios"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.nombre }}</td>
        <td class="text-xs-right">{{ props.item.apellido }}</td>
        <td class="text-xs-right">{{ props.item.tipo }}</td>
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
        <v-btn color="primary" @click="initialize">Reiniciar</v-btn>
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
      { text: "Apellido", value: "apellido" },
      { text: "Tipo", value: "tipo" },
      { text: "Actions", value: "name", sortable: false }
    ],
    usuarios: [],
    tipos: ["administrador", "director", "profesor", "asesor", "comite"],
    editedIndex: -1,
    editedItem: {
      id: 0,
      nombre: "",
      apellido: "",
      email: "",
      password: "",
      tipo: "",
      telefono: "",
      rut: ""
    },
    defaultItem: {
      id: 0,
      nombre: "",
      apellido: "",
      email: "",
      password: "",
      tipo: "",
      telefono: "",
      rut: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo Usuario" : "Editar Usuarios";
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
      this.cargarUsuarios();
    },

    editItem(item) {
      this.editedIndex = this.usuarios.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const id = item.id;
      confirm("Estas seguro de querer eliminar este usuario?") &&
        this.eliminarUsuario(id);
      this.cargarUsuarios();
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
        this.actualizarUsuario();
      } else {
        this.guardarUsuario();
      }
      this.cargarUsuarios();
      this.close();
    },
    cargarUsuarios() {
      var url = "/usuarios";
      axios
        .get(url)
        .then(response => {
          this.usuarios = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    guardarUsuario() {
      var url = "/usuario/store";
      axios
        .post(url, {
          nombre: this.editedItem.nombre,
          apellido: this.editedItem.apellido,
          email: this.editedItem.email,
          password: this.editedItem.password,
          tipo: this.editedItem.tipo,
          telefono: this.editedItem.telefono,
          rut: this.editedItem.rut
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizarUsuario() {
      var url = "/usuario/" + this.editedItem.id + "/update";
      axios
        .put(url, {
          nombre: this.editedItem.nombre,
          apellido: this.editedItem.apellido,
          email: this.editedItem.email,
          password: this.editedItem.password,
          tipo: this.editedItem.tipo,
          telefono: this.editedItem.telefono,
          rut: this.editedItem.rut
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminarUsuario(id) {
      var url = "/usuario/" + id + "/delete";
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
