<template>
  <v-container fluid pa-0>
    <v-layout>
      <v-flex>
        <detalle-syllabus :syllabus="syllabus"></detalle-syllabus>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex>
        <v-textarea name="input-7-1" box label="comentario" auto-grow value></v-textarea>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-spacer></v-spacer>
      <v-btn fab dark color="blue">
        <v-flex align-center justify-center>
          <v-icon dark>done</v-icon>
        </v-flex>
      </v-btn>
      <v-btn fab dark color="red">
        <v-flex align-center justify-center>
          <v-icon dark>close</v-icon>
        </v-flex>
      </v-btn>
    </v-layout>
  </v-container>
</template>

<script>
import DetalleSyllabus from "./DetalleSyllabus.vue";

export default {
  data() {
    return {};
  },
  props: {
    syllabus: {}
  },
  components: {
    DetalleSyllabus
  }
};
</script>
