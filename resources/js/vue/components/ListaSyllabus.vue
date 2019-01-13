<template>
  <v-container fluid>
    <v-tabs dark show-arrows>
      <v-tabs-slider></v-tabs-slider>
      <v-tab v-if="syllabusSemestre.length <= 0">Sin Syllabus</v-tab>
      <v-tab
        v-else
        v-for="item in syllabusSemestre"
        :key="item.semestre"
        v-model="tabActiva"
      >{{ item.semestre }}</v-tab>
      <v-tabs-items>
        <v-tab-item v-for="item in syllabusSemestre" :key="item.semestre">
          <v-container fluid grid-list-md>
            <v-data-iterator
              :items="item.syllabus"
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
                lg2
                @click="clickSyllabus(props.item)"
              >
                <v-card>
                  <v-card-title>
                    <v-flex title>{{ props.item.nombre }}</v-flex>
                  </v-card-title>
                  <v-divider></v-divider>
                  <v-list dense>
                    <v-list-tile>
                      <v-list-tile-content>Curso:</v-list-tile-content>
                      <v-list-tile-content class="align-end">{{ props.item.curso.nombre }}</v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile>
                      <v-list-tile-content>Estado:</v-list-tile-content>
                      <v-list-tile-content class="align-end">{{ props.item.estado }}</v-list-tile-content>
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
export default {
  created() {
    this.cargarSyllabus();
  },
  data() {
    return {
      rowsPerPageItems: [4, 8, 12],
      pagination: {
        rowsPerPage: 4
      },
      tabActiva: null,
      syllabusSemestre: []
    };
  },
  props: {
    filtro: {
      campo: "",
      valor: ""
    }
  },
  computed: {
    conFiltro() {
      if (this.filtro.campo != "" && this.filtro.valor != "") {
        return "si";
      } else {
        return "no";
      }
    }
  },
  watch: {},
  methods: {
    clickSyllabus(syllabus) {
      this.$emit("clickSyllabus", syllabus);
    },
    cargarSyllabus() {
      var url = "/syllabusSemestre";
      axios
        .post(url, {
          filtro: this.conFiltro,
          campo: this.filtro.campo,
          valor: this.filtro.valor
        })
        .then(response => {
          this.syllabusSemestre = response.data;
          this.$forceUpdate;
        });
    }
  }
};
</script>
