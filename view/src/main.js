import Vue from 'vue'
import App from './App.vue'
import Vuex from 'vuex'
import Router from 'vue-router'
import StoreInit from './store'
import RouterInit from "./router"
import {ApiGet, ApiPost, ApiPut, ApiDelete} from "./helper/api"
import jquery from "jquery"
import Cookies from "js-cookie"

window.$ = jquery;
window.jQuery = jquery;
window.Cookies = Cookies;

require('./assets/vendor/bootstrap/js/bootstrap');
require('./assets/js/sb-admin-2');
require('./assets/scss/sb-admin-2.scss');

Vue.use(Vuex);
Vue.use(Router);
window.Vue = Vue;
window.ApiGet = ApiGet;
window.ApiPost = ApiPost;
window.ApiPut = ApiPut;
window.ApiDelete = ApiDelete;

// Vue.directive('hightlight', {
//     bind(el, binding, vnode) {
//         el.style.backgroundColor = 'blue'}
// });

Vue.config.productionTip = false;

const store = new Vuex.Store(StoreInit);
const router = new Router(RouterInit);

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.loggedIn) {
            next({
                name: 'login',
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        if (store.getters.loggedIn) {
            next({
                name: 'Home',
            })
        } else {
            next()
        }
    } else {
        next()
    }
});


new Vue({
    router,
    store,
    render: h => h(App),
}).$mount('#app');
