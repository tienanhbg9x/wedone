import axios from "axios";
import Cookies from "js-cookie"

const Home = () => {
    return {
        state: {
            token: Cookies.get('access_token') ? Cookies.get('access_token') : null,
            user_id: Cookies.get('user_id') ? parseInt(Cookies.get('user_id')) : null,
            user_info:null
        },
        getters: {
            loggedIn(state) {
                return state.token !== null;
            },
            USER_ID(state) {
                return state.user_id;
            },
            USER_INFO(state) {
                return state.user_info;
            }
        },
        mutations: {
            retrieveToken(state, token) {
                state.token = token;
            },
            destroyToken(state) {
                state.token = null;
            },
            SET_USER_ID(state, payload) {
                state.user_id = payload;
            },
            SET_USER_INFO(state, payload) {
                state.user_info = payload;
            }
        },
        actions: {
            register(context, data) {
                return new Promise((resolve, reject) => {
                    ApiPost('v1/register', {
                        name: data.name,
                        email: data.email,
                        password: data.password
                    })
                        .then(response => {
                            resolve(response)
                        })
                        .catch(error => {
                            reject(error)
                        })
                })
            },
            retrieveToken(context, credentials) {
                return new Promise((resolve, reject) => {
                    ApiPost('v1/login', {
                        email: credentials.email,
                        password: credentials.password
                    })
                        .then(response => {
                            const token = response.data.access_token;
                            const user_id = response.data.user_id;
                            Cookies.set('access_token', token);
                            Cookies.set('user_id', user_id);
                            context.commit('retrieveToken', token);
                            resolve(response)
                        })
                        .catch(error => {
                            reject(error)
                        })
                })
            },
            destroyToken(context) {
                axios.defaults.headers.common['Authorization'] = 'Bearer' + context.state.token;
                if (context.getters.loggedIn) {
                    Cookies.remove('access_token');
                    Cookies.remove('user_id');
                    context.commit('destroyToken');
                } else {
                    Cookies.remove('access_token');
                    Cookies.remove('user_id');
                    context.commit('destroyToken');

                }
            }
        }
    }
};

export default Home;