<template>
    <v-container>
        <v-layout align-center justify-space-around row fill-height>
            <v-flex xs12>
                <v-card>
                    <v-card-title primary-title >
                        <v-flex text-xs-center>
                            <h3  class="headline mb-0"></h3>
                        </v-flex>
                    </v-card-title>
                    <v-card-text>
                        <v-layout v-for="item in syllabus" :key="item.id" align-center>
                            <v-flex xs6 text-xs-right py-0>
                                Syllabus: {{item.nombre}}  {{item.semestre}}
                            </v-flex>
                            <v-flex xs6 text-xs-left py-0>
                                <v-btn small=""
                                        color="blue-grey"
                                        class="white--text"
                                    >
                                        Descarga
                                        <v-icon right dark>cloud_download</v-icon>
                                </v-btn>
                            </v-flex>

                        </v-layout>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>

                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
export default {
  data: () => ({
    syllabus: [
      {
        nombre: "syllabus.pdf",
        semestre: "2018-1",
        id: 1
      },
      {
        nombre: "syllabus.pdf",
        semestre: "2018-2",
        id: 2
      }
    ]
  })
};
</script>

