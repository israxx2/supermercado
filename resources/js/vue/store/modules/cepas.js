export default {
    namespaced: true,
    state: {
        all: []
    },
    getters: {},
    actions: {
        crear({ commit }, data) {
            var url = "/cepasCrear";
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
            var url = "/cepasEditar";
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
            var url = "/cepasBorrar";
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
            var url = "/cepasAll";
            axios
                .post(url)
                .then(response => {
                    state.all = response.data;
                    toastr.info("Cepas Cargadas", "Resultado");
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        }
    }
};
