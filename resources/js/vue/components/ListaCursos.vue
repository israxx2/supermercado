<template>
  <v-container fluid>
    <v-tabs dark show-arrows>
      <v-tabs-slider></v-tabs-slider>
      <v-tab
        v-for="item in cursosSemestre"
        :key="item.semestre"
        v-model="tabActiva"
      >{{ item.semestre }}</v-tab>
      <v-tabs-items>
        <v-tab-item v-for="item in cursosSemestre" :key="item.semestre">
          <v-container fluid grid-list-md>
            <v-data-iterator
              :items="item.cursos"
              :rows-per-page-items="rowsPerPageItems"
              :pagination.sync="pagination"
              content-tag="v-layout"
              row
              wrap
            >
              <v-flex
                slot="item"
                slot-scope="props"
                xs12
                sm6
                md4
                lg3
                @click="clickCurso(props.item)"
              >
                <v-card>
                  <v-card-title>
                    <v-flex title>{{ props.item.nombre }}</v-flex>
                  </v-card-title>
                  <v-divider></v-divider>
                  <v-list dense>
                    <v-list-tile>
                      <v-list-tile-content>Profesor:</v-list-tile-content>
                      <v-list-tile-content class="align-end">{{ props.item.profesor_asignado }}</v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile v-if="props.item.syllabus">
                      <v-list-tile-content>Syllabus:</v-list-tile-content>
                      <v-list-tile-content class="align-end">{{ props.item.syllabus.estado }}</v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile v-else>
                      <v-list-tile-content>Syllabus:</v-list-tile-content>
                      <v-list-tile-content class="align-end">sin subir</v-list-tile-content>
                    </v-list-tile>
                  </v-list>
                </v-card>
              </v-flex>
            </v-data-iterator>
          </v-container>
        </v-tab-item>
      </v-tabs-items>
    </v-tabs>
  </v-container>
</template>

<script>
import { EventBus } from "./../event-bus";

export default {
  created() {
    this.cargarCursos();
    EventBus.$on("cerrarAsignacionProfesor", () => {
      this.cargarCursos();
    });
  },
  data() {
    return {
      rowsPerPageItems: [4, 8, 12],
      pagination: {
        rowsPerPage: 4
      },
      cursosSemestre: [],
      tabActiva: null
    };
  },
  computed: {},
  methods: {
    clickCurso(curso) {
      this.$emit("clickCurso", curso);
    },
    cargarCursos() {
      var url = "/cursosSemestre";
      axios.get(url).then(response => {
        this.cursosSemestre = response.data;
        this.tabActiva = this.cursosSemestre.length - 1;
      });
    }
  }
};
</script>
