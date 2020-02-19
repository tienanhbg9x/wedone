import Home from "./modules/Home"

export default {
    state:{
        demo:3434
    },
    getters:{
        GET_DEMO(state){
            return state.demo;
        }
    },
    mutations:{
        SET_DEMO(state,payload){
            state.demo = payload;
        }
    },
    actions:{

    },
    modules:{
        Home: Home(),
    }
};