import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import usuarios from "./modules/usuarios";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        usuario: null
    },
    actions: {
        login({ state }, data) {
            var url = "/api/login";
            axios
                .post(url, {
                    rut: data.rut,
                    password: data.password
                })
                .then(response => {
                    console.log(JSON.stringify(response));
                    if (response.data.id_rol != -1) {
                        state.usuario = response.data;
                        toastr.success("Login Exitoso", "Resultado", {
                            positionClass: "toast-bottom-right"
                        });
                    } else {
                        toastr.error("Login Fallido", "Resultado", {
                            positionClass: "toast-top-center"
                        });
                    }
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        },
        logout({ state }) {
            var url = "/api/logout";
            axios
                .post(url)
                .then(response => {
                    console.log(JSON.stringify(response));
                    state.usuario = null;
                    router.push({ name: "login" });
                })
                .catch(error => {
                    console.log(JSON.stringify(error));
                    toastr.warning(error.message, "Mensaje");
                });
        }
    },
    mutations: {},
    modules: { usuarios }
});
