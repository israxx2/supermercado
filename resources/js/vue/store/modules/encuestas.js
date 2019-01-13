export default {
    namespaced: true,
    state: {
        all: []
    },
    getters: {},
    actions: {
        crear({ commit }, data) {
            var url = "/encuestasCrear";
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
            var url = "/encuestasEditar";
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
            var url = "/encuestasBorrar";
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
        finalizar({ commit }, data) {
            var url = "/llenarEncuesta";
            axios
                .post(url, {
                    COMPRA: data.num_boleta,
                    VALORACION: data.valoracion,
                    SUGERENCIA: data.sugerencia
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
        }
    },
    mutations: {
        cargar(state) {
            var url = "/encuestasAll";
            axios
                .post(url)
                .then(response => {
                    state.all = response.data;
                    toastr.info("Encuestas Cargadas", "Resultado");
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        }
    }
};
