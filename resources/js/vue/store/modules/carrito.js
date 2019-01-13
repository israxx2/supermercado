export default {
    namespaced: true,
    state: {
        all: []
    },
    getters: {},
    actions: {
        crear({ dispatch }, data) {
            var url = "/carritoCrear";
            axios
                .post(url, {
                    RUT: data.rut,
                    COD: data.producto,
                    CANTIDAD: data.cantidad
                })
                .then(response => {
                    console.log(response);
                    toastr.info(response.data, "Resultado");
                    dispatch("cargar", { rut: data.rut });
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        },
        editar({ dispatch }, data) {
            var url = "/carritoEditar";
            axios
                .post(url, {
                    COD: data.codigo,
                    NOMBRE: data.nombre
                })
                .then(response => {
                    console.log(response);
                    toastr.info(response.data, "Resultado");
                    dispatch("cargar", { rut: data.rut });
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        },
        borrar({ dispatch }, data) {
            var url = "/carritoBorrar";
            axios
                .post(url, {
                    COD: data.codigo,
                    RUT: data.rut
                })
                .then(response => {
                    console.log(response);
                    toastr.info(response.data, "Resultado");
                    dispatch("cargar", { rut: data.rut });
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        },
        cargar({ state }, data) {
            var url = "/carritoAll";
            axios
                .post(url, {
                    RUT: data.rut
                })
                .then(response => {
                    state.all = response.data;
                    toastr.info("Carrito Cargado", "Resultado");
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        },
        finalizar({ dispatch }, data) {
            var url = "/compraFinalizar";
            axios
                .post(url, {
                    NUM_BOLETA: data.num_boleta,
                    CIUDAD: data.cuidad,
                    CALLE: data.cale,
                    NUMERO: data.numero
                })
                .then(response => {
                    console.log(response);
                    toastr.info(response.data, "Resultado");
                    dispatch("cargar", { rut: data.rut });
                })
                .catch(error => {
                    console.log(error);
                    toastr.warning(error.message, "Mensaje");
                });
        }
    },
    mutations: {}
};
