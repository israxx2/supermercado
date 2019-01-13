import Vue from "vue";
import Vuex from "vuex";
import cepas from "./modules/cepas";
import usuarios from "./modules/usuarios";
import vinos from "./modules/vinos";
import carrito from "./modules/carrito";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: { cepas, usuarios, vinos, carrito }
});
