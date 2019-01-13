import router from "../../router";

export default {
    namespaced: true,
    state: {
        all: [],
        actual: { tipo: "INVITADO", nombre: "Invitado", correo: "" }
    },
    getters: {},
    actions: {
        crear({ commit }, data) {
            var url = "/usuariosCrear";
            axios
                .post(url, {
                    NOMBRE: data.nombre
                })
                .then(response => {
                    console.log(response);
                    toastr.info(response.data, "Resultado");
                    commit("cargar");
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        },
        editar({ commit }, data) {
            var url = "/usuariosEditar";
            axios
                .post(url, {
                    COD: data.codigo,
                    NOMBRE: data.nombre
                })
                .then(response => {
                    console.log(response);
                    toastr.info(response.data, "Resultado");
                    commit("cargar");
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        },
        borrar({ commit }, data) {
            var url = "/usuariosBorrar";
            axios
                .post(url, {
                    COD: data.codigo
                })
                .then(response => {
                    console.log(response);
                    toastr.info(response.data, "Resultado");
                    commit("cargar");
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        },
        login({ state, commit }, data) {
            var url = "/login";
            axios
                .post(url, {
                    CORREO: data.correo,
                    CONTRASENA: data.contrasena
                })
                .then(response => {
                    console.log(response);
                    toastr.info(response.data, "Resultado");
                    if (response.data == "INGRESO EXITOSO") {
                        state.actual.correo = data.correo;
                        commit("cargarInfoUsuario");
                    }
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        },
        cargarLogin({ state }) {
            var actual = localStorage.getItem("usuarioActual");
            if (actual != null) {
                state.actual = JSON.parse(actual);
            }
        },
        logout({ state }) {
            state.actual = { tipo: "invitado" };
            localStorage.removeItem("usuarioActual");
            router.push({name: "welcome"});
        },
        registro({ commit },data){
            var url = "/registro";
            axios
                .post(url, {
                    RUT: data.rut,
                    NOM: data.nombre,
                    APE1: data.apellido1,
                    APE2: data.apellido2,
                    FONO: data.telefono,
                    CIUDAD: data.cuidad,
                    CALLE: data.calle,
                    NUMERO: data.numero,
                    CORREO: data.correo,
                    CONTRASENA: data.contrasena,
                })
                .then(response => {
                    console.log(response);
                    toastr.info(response.data, "Resultado");
                    commit("cargar");
                    commit("cargarInfoUsuario");
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        }
    },
    mutations: {
        cargar(state) {
            var url = "/usuariosAll";
            axios
                .post(url)
                .then(response => {
                    state.all = response.data;
                    toastr.info("Usuarios Cargadas", "Resultado");
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        },
        cargarInfoUsuario(state) {
            var url = "/infoUsuario";
            axios
                .post(url, {
                    correo: state.actual.correo
                })
                .then(response => {
                    state.actual = response.data;
                    toastr.info("Login Exitoso", "Resultado");
                    localStorage.setItem(
                        "usuarioActual",
                        JSON.stringify(state.actual)
                    );
                    if(response.data.tipo == "ADMINISTRADOR"){
                        router.push({name: "admin"});
                    } else {
                        router.push({name: "home"});
                    }
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        }
    }
};
