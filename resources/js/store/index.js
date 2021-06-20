import Vue from 'vue'
import Vuex from 'vuex'
import actions from './modules/actions'
import mutations from './modules/mutations'
import getters from './modules/getters'
import state from "./modules/state";
//import VuexPersistence from 'vuex-persist';

Vue.use(Vuex);

// const vuexPersist = new VuexPersist({
//   key: 'open-account',
//   storage: window.localStorage
// })

// const vuexLocal = new VuexPersistence({
//   storage: window.localStorage
// })

// const store = {
//   state,
//   mutations,
//   getters,
//   actions,
//   plugins: [vuexLocal.plugin]
// }

export default new Vuex.Store(
  {
    state,
    mutations,
    getters,
    actions,
    //    plugins: [vuexLocal.plugin]
  }
)