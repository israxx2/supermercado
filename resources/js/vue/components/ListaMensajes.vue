<template>
    <v-container fluid grid-list-md>
        <v-data-iterator
            :items="mensajes"
            :rows-per-page-items="rowsPerPageItems"
            :pagination.sync="pagination"
            content-tag="v-layout"
            row
            wrap
        >
        <v-toolbar
            slot="header"
            class="mb-2"
            dark
            flat
        >
            <v-toolbar-title>Mensajes</v-toolbar-title>
        </v-toolbar>
            <v-flex
                slot="item"
                slot-scope="props"
                xs12
                @click="clickMensaje(props.item)"
            >
                <v-card>
                    <v-card-title>
                        <v-flex title>
                            {{ props.item.curso }} - {{props.item.generacion}}
                        </v-flex>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-list dense>
                        <v-list-tile>
                            <v-list-tile-content>Estado:</v-list-tile-content>
                            <v-list-tile-content class="align-end">{{ props.item.estado }}</v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile>
                            <v-list-tile-content>Resumen:</v-list-tile-content>
                            <v-list-tile-content class="align-end">{{ props.item.resumen }}</v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-card>
            </v-flex>
        </v-data-iterator>
    </v-container>
</template>

<script>
export default {
  data() {
    return {
      rowsPerPageItems: [2, 4, 6],
      pagination: {
        rowsPerPage: 2
      },
      mensajes: [
        {
          curso: "curso1",
          generacion: "2010",
          estado: "desaprobado",
          resumen: "pocas evaluaciones ...",
          mensaje: "pocas evaluaciones"
        },
        {
          curso: "curso2",
          generacion: "2010",
          estado: "desaprobado",
          resumen: "pocas evaluaciones ...",
          mensaje: "pocas evaluaciones"
        },
        {
          curso: "curso3",
          generacion: "2010",
          estado: "desaprobado",
          resumen: "pocas evaluaciones ...",
          mensaje: "pocas evaluaciones"
        },
        {
          curso: "curso4",
          generacion: "2010",
          estado: "desaprobado",
          resumen: "pocas evaluaciones ...",
          mensaje: "pocas evaluaciones"
        }
      ]
    };
  },
  methods: {
    clickMensaje(mensaje) {
      this.$emit("clickMensaje", mensaje);
    }
  }
};
</script>
