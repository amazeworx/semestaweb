import Vue from 'vue'
import Vuex from 'vuex'
import state from "./modules/state";
import actions from './modules/actions'
import mutations from './modules/mutations'
import getters from './modules/getters'
import VuexPersistence from 'vuex-persist';

Vue.use(Vuex);

const vuexLocal = new VuexPersistence({
  key: 'open-account',
  storage: window.localStorage
})

export default new Vuex.Store(
  {
    state,
    actions,
    mutations,
    getters,
    plugins: [vuexLocal.plugin]
  }
)