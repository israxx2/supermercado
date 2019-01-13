<template>
  <v-app>
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    prepend-icon="person"
                    name="login"
                    label="Correo"
                    type="text"
                    v-model="login"
                    :error-messages="loginErrors"
                    @input="$v.login.$touch()"
                    @blur="$v.login.$touch()"
                  ></v-text-field>
                  <v-text-field
                    prepend-icon="lock"
                    name="password"
                    label="Contraseña"
                    type="password"
                    v-model="password"
                    counter
                    :error-messages="passwordErrors"
                    @input="$v.password.$touch()"
                    @blur="$v.password.$touch()"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn @click="submit" color="primary">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, minLength, email } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],
  validations: {
    login: { required, email },
    password: { required, minLength: minLength(6) }
  },
  data: () => ({
    login: "",
    password: ""
  }),
  computed: {
    passwordErrors() {
      const errors = [];
      if (!this.$v.password.$dirty) return errors;
      !this.$v.password.minLength &&
        errors.push("El password debe tener mas de 6 caracteres.");
      !this.$v.password.required && errors.push("El password es requerido.");
      return errors;
    },
    loginErrors() {
      const errors = [];
      if (!this.$v.login.$dirty) return errors;
      !this.$v.login.email && errors.push("El correo tiene que ser valido");
      !this.$v.login.required && errors.push("El correo es requerido");
      return errors;
    }
  },

  methods: {
    submit() {
      this.$v.$touch();
    }
  }
};
</script>
