import Vue from 'vue'
import Vuex from 'vuex'
import actions from './modules/actions'
import mutations from './modules/mutations'
import getters from './modules/getters'
import state from "./modules/state";
import VuexPersistence from 'vuex-persist';

Vue.use(Vuex);

const vuexLocal = new VuexPersistence({
  key: 'open-account',
  storage: window.localStorage
})

export default new Vuex.Store(
  {
    state,
    mutations,
    getters,
    actions,
    plugins: [vuexLocal.plugin]
  }
)