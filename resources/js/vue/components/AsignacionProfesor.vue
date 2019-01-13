<template>
  <v-form>
    <v-container>
      <v-layout>
        <v-flex xs6 text-xs-right title>Curso:</v-flex>
        <v-flex xs6 text-xs-left title>{{curso.nombre}} - {{curso.codigo}}</v-flex>
      </v-layout>
      <v-layout>
        <v-flex xs6 text-xs-right title>Profesor Asignado:</v-flex>
        <v-flex xs6 text-xs-left title>{{profesorAsignado}}</v-flex>
      </v-layout>
      <v-layout>
        <v-flex text-xs-center>
          <v-text-field flat label="Buscar" prepend-inner-icon="search" v-model="buscar"></v-text-field>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex>
          <v-select
            :items="items"
            item-text="nombre_completo"
            return-object
            label="Profesor"
            v-model="profesor"
          ></v-select>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-spacer></v-spacer>
        <v-btn color="green" dark @click="asignarProfesor">Asignar</v-btn>
      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
import { EventBus } from "./../event-bus";

export default {
  created() {
    this.cargarProfesores();
  },
  data() {
    return {
      profesores: [],
      profesor: {},
      buscar: ""
    };
  },
  props: {
    curso: {}
  },
  computed: {
    profesorAsignado() {
      if (this.curso.Profesor) {
        return this.curso.Profesor.nombre + " " + this.curso.Profesor.apellido;
      } else {
        return "no asignado";
      }
    },
    items() {
      if (this.buscar != "") {
        const profesores = this.profesores.filter(
          item =>
            item.nombre.search(this.buscar) > -1 ||
            item.apellido.search(this.buscar) > -1
        );
        this.profesor = profesores[0];
        return profesores;
      } else {
        this.profesor = this.profesores[0];
        return this.profesores;
      }
    }
  },
  methods: {
    cargarProfesores() {
      var url = "/profesores";
      axios
        .get(url)
        .then(response => {
          this.profesores = response.data;
          this.profesor = this.profesores[0];
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    asignarProfesor() {
      var url =
        "/curso/" + this.curso.id + "/asignarProfesor/" + this.profesor.id;
      axios
        .post(url)
        .then(response => {
          console.log(response);
          this.$emit("cerrarAsignacionProfesor");
          EventBus.$emit("cerrarAsignacionProfesor");
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
