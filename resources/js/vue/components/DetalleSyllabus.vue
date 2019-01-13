<template>
  <v-container fluid grid-list-lg pa-0>
    <v-layout align-center justify-space-around row fill-height>
      <v-flex xs12>
        <v-card>
          <v-card-title primary-title>
            <v-flex text-xs-center>
              <h3 class="headline mb-0">{{syllabus.nombre}}</h3>
            </v-flex>
          </v-card-title>
          <v-card-text>
            <v-layout align-center>
              <v-flex xs6 text-xs-right py-0>Curso:</v-flex>
              <v-flex xs6 text-xs-left py-0>{{syllabus.curso.nombre}}</v-flex>
            </v-layout>
            <v-layout align-center>
              <v-flex xs6 text-xs-right py-0>Semestre:</v-flex>
              <v-flex xs6 text-xs-left py-0>{{syllabus.curso.semestre}}</v-flex>
            </v-layout>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <a :href="'/storage/'+syllabus.url" download>
              <v-btn color="blue-grey" class="white--text">Descarga
                <v-icon dark>cloud_download</v-icon>
              </v-btn>
            </a>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
    <v-layout align-center justify-space-around row fill-height>
      <v-flex xs12>
        <v-card>
          <v-card-title primary-title>
            <v-flex text-xs-center>
              <h3 class="headline mb-0">Fechas Pruebas</h3>
            </v-flex>
          </v-card-title>
          <v-card-text>
            <v-list text-xs-center dense>
              <v-list-tile v-for="fecha_prueba in syllabus.fecha_pruebas" :key="fecha_prueba.id">
                <v-layout align-center>
                  <v-flex xs6 text-xs-right py-0>{{fecha_prueba.nombre}}:</v-flex>
                  <v-flex xs6 text-xs-left py-0>{{fecha_prueba.fecha}}</v-flex>
                </v-layout>
              </v-list-tile>
            </v-list>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  data() {
    return {};
  },
  props: {
    syllabus: {}
  }
};
</script>
