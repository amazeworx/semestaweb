import Vue from "vue";
import Vuex from "vuex";
import accountOpening from './modules/account-opening';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    accountOpening
  },
});