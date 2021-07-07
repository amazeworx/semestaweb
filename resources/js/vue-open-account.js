require("./bootstrap");

import Vue from "vue";
import VueRouter from 'vue-router';
import Vuelidate from 'vuelidate';
import vSelect from 'vue-select';
import VueOpenAccount from './components/VueOpenAccount/VueOpenAccount.vue';
import store from './store/index';
import VueSignaturePad from "vue-signature-pad";

import FormStepOne from './components/VueOpenAccount/FormStepOne.vue';
import FormStepTwo from './components/VueOpenAccount/FormStepTwo.vue';
import FormStepThree from './components/VueOpenAccount/FormStepThree.vue';
//import FormStepFour from './components/VueOpenAccount/FormStepFour.vue';

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(VueSignaturePad);
Vue.component('v-select', vSelect);

const routes = [
  { path: '/first-step', name: 'firstStep', component: FormStepOne },
  { path: '/second-step', name: 'secondStep', component: FormStepTwo },
  { path: '/third-step', name: 'thirdStep', component: FormStepThree }
  //{ path: '/vue-open-account/4', name: 'FormStepFour', component: FormStepFour }
];

let router = new VueRouter({
  mode: 'hash',
  routes,
  store
});

new Vue({
  el: "#app",
  router,
  store,
  render: h => h(VueOpenAccount)
})