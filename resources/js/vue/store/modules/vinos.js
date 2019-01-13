export default {
    namespaced: true,
    state: {
        all: []
    },
    getters: {},
    actions: {
        crear({ commit }, data) {
            var url = "/vinosCrear";
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
            var url = "/vinosEditar";
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
            var url = "/vinosBorrar";
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
        }
    },
    mutations: {
        cargar(state) {
            var url = "/vinosAll";
            axios
                .post(url)
                .then(response => {
                    state.all = response.data;
                    toastr.info("Vinos Cargadas", "Resultado");
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        }
    }
};
