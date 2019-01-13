/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require("vue");

import App from "./vue/App";
import router from "./vue/router";
import store from "./vue/store/store";

import Vuetify from "vuetify";

Vue.use(Vuetify);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.config.productionTip = false;

const app = new Vue({
    router,
    store,
    render: h => h(App)
}).$mount("#app");
