<template>
  <div>
    <v-toolbar flat color="white">
      <v-toolbar-title>Syllabus</v-toolbar-title>
      <v-divider class="mx-2" inset vertical></v-divider>
      <v-spacer></v-spacer>
      <v-dialog v-model="dialog" max-width="500px">
        <v-btn slot="activator" color="primary" dark class="mb-2">Nuevo syllabus</v-btn>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container fluid ma-0 pa-0>
              <v-layout>
                <v-select
                  :items="cursos"
                  label="Curso"
                  item-value="id"
                  item-text="nombre_completo"
                  v-model="editedItem.curso_id"
                ></v-select>
              </v-layout>
              <v-spacer></v-spacer>
              <v-layout>
                <v-select :items="estados" label="Estado" v-model="editedItem.estado"></v-select>
              </v-layout>
              <v-layout>
                <v-text-field v-model="editedItem.comentario" label="Comentario"></v-text-field>
              </v-layout>
              <v-layout>
                <input type="file" label="Syllabus" required @change="getArchivo">
              </v-layout>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">Cancelar</v-btn>
            <v-btn color="blue darken-1" flat @click="save">Guardar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-toolbar>
    <v-data-table :headers="headers" :items="syllabus" hide-actions class="elevation-1">
      <template slot="items" slot-scope="props">
        <td>{{ props.item.estado }}</td>
        <td class="text-xs-right">{{ props.item.curso_id }}</td>
        <td class="text-xs-right">{{ props.item.url }}</td>
        <td class="text-xs-right">{{ props.item.comentario }}</td>
        <td class="justify-center align-center layout px-0">
          <a :href="'/storage/'+props.item.url" download>
            <v-icon small class="mr-2">cloud_download</v-icon>
          </a>
          <v-icon small @click="editItem(props.item)">edit</v-icon>
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
      { text: "Estado", align: "left", value: "estado" },
      { text: "Curso", value: "curso_id" },
      { text: "Url", value: "Url" },
      { text: "Comentario", value: "comentario" },
      { text: "Actions", value: "estado", sortable: false }
    ],
    syllabus: [],
    cursos: [],
    estados: ["pendiente", "aceptado", "rechazado"],
    editedIndex: -1,
    editedItem: {
      curso_id: "",
      estado: "",
      url: "",
      comentario: ""
    },
    defaultItem: {
      curso_id: "",
      estado: "",
      url: "",
      comentario: ""
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo Syllabus" : "Editar Syllabus";
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
      this.cargarSyllabus();
      this.cargarCursos();
    },

    editItem(item) {
      this.editedIndex = this.syllabus.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const id = item.id;
      confirm("Estas seguro de querer eliminar este syllabus?") &&
        this.eliminarSyllabus(id);
      this.cargarSyllabus();
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
        this.actualizarSyllabus();
      } else {
        this.guardarSyllabus();
      }
      this.cargarSyllabus();
      this.close();
    },
    cargarSyllabus() {
      var url = "/syllabus";
      axios.get(url).then(response => {
        this.syllabus = response.data;
      });
    },
    getArchivo: function(event) {
      this.archivo = event.target.files[0];
    },
    guardarSyllabus() {
      var url = "/curso/" + this.editedItem.curso_id + "/syllabus/store";
      var data = new FormData();
      data.append("syllabus", this.archivo);
      data.append("curso_id", this.editedItem.curso_id);
      data.append("estado", this.editedItem.estado);
      data.append("comentario", this.editedItem.comentario);
      data.append("_method", "POST");
      axios
        .post(url, data)
        .then(response => {
          console.log(response);
          this.cargarSyllabus();
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizarSyllabus() {
      var url = "/syllabus/" + this.editedItem.id + "/update";
      axios
        .put(url, {
          curso_id: this.editedItem.curso_id,
          estado: this.editedItem.estado,
          url: this.editedItem.url,
          comentario: this.editedItem.comentario
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    eliminarSyllabus(id) {
      var url = "/syllabus/" + id + "/delete";
      axios
        .delete(url)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cargarCursos() {
      var url = "/cursos";
      axios
        .get(url)
        .then(response => {
          console.log(response);
          this.cursos = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
