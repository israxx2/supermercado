<template>
  <v-form>
    <v-container>
      <v-layout>
        <v-flex>
          <input type="file" label="Syllabus" required @change="getArchivo">
        </v-flex>
      </v-layout>
      <v-layout v-for="(item, index) in fechaPruebas" :key="index">
        <v-flex>
          <v-text-field v-model="item.fecha" label="Fecha Prueba" required></v-text-field>
        </v-flex>
        <v-flex>
          <v-text-field v-model="item.nombre" label="Nombre Prueba" required></v-text-field>
        </v-flex>
        <v-flex v-if="index == fechaPruebas.length - 1">
          <v-btn fab dark color="indigo" small @click="nuevaFecha">
            <v-flex justify-center align-center>
              <v-icon dark>add</v-icon>
            </v-flex>
          </v-btn>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-spacer></v-spacer>
        <v-btn @click="clickEnviar">Enviar</v-btn>
      </v-layout>
    </v-container>
  </v-form>
</template>
<script>
export default {
  data() {
    return {
      syllabus: "",
      fechaPruebas: [
        {
          fecha: "",
          nombre: ""
        }
      ]
    };
  },
  props: {
    curso: {}
  },
  methods: {
    clickEnviar() {
      this.guardarSyllabus();
      this.$emit("clickEnviar");
    },
    getArchivo: function(event) {
      this.archivo = event.target.files[0];
    },
    guardarSyllabus() {
      var url = "/curso/" + this.curso.id + "/syllabus/store";
      var data = new FormData();
      data.append("syllabus", this.archivo);
      data.append("curso_id", this.curso.id);
      data.append("fecha_pruebas", JSON.stringify(this.fechaPruebas));
      data.append("estado", "pendiente");
      data.append("comentario", "");
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
    nuevaFecha() {
      this.fechaPruebas.push({
        fecha: "",
        nombre: ""
      });
    }
  }
};
</script>
