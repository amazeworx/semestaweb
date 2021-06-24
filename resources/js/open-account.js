require("./bootstrap");

import Vue from "vue";
import { extend, localize, setInteractionMode } from "vee-validate";
import en from 'vee-validate/dist/locale/en.json';
import * as rules from 'vee-validate/dist/rules';
import store from './store-1';
import AccountOpening from './components/AccountOpening.vue';

Vue.mixin(require('./trans'));

// install rules and localization
Object.keys(rules).forEach(rule => {
  extend(rule, rules[rule]);
});

localize('en', en);

setInteractionMode('lazy');

new Vue({
  el: '#app',
  store,
  render: h => h(AccountOpening)
})