export default {
    namespaced: true,
    state: {
        all: []
    },
    getters: {},
    actions: {
        crear({ commit }, data) {
            var url = "/marcasCrear";
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
            var url = "/marcasEditar";
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
            var url = "/marcasBorrar";
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
            var url = "/marcasAll";
            axios
                .post(url)
                .then(response => {
                    state.all = response.data;
                    toastr.info("marcas Cargadas", "Resultado");
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        }
    }
};
