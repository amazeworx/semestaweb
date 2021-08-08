require("./bootstrap");

import Vue from "vue";
import VueRouter from 'vue-router';
import Vuelidate from 'vuelidate';
import vSelect from 'vue-select';
import VueOpenAccount from './components/VueOpenAccount/VueOpenAccount.vue';
import store from './store/index';
import VueSignaturePad from "vue-signature-pad";
import VueTelInput from 'vue-tel-input';

import PreForm from './components/VueOpenAccount/PreForm.vue';
import PreFormOtp from './components/VueOpenAccount/PreFormOtp.vue';
import FormStepOne from './components/VueOpenAccount/FormStepOne.vue';
import FormStepTwo from './components/VueOpenAccount/FormStepTwo.vue';
import FormStepThree from './components/VueOpenAccount/FormStepThree.vue';
import FormStepFour from './components/VueOpenAccount/FormStepFour.vue';
import PostForm from './components/VueOpenAccount/PostForm.vue';

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(VueSignaturePad);
Vue.use(VueTelInput);
Vue.component('v-select', vSelect);

const routes = [
  { path: '/', name: 'preForm', component: PreForm },
  { path: '/otp', name: 'preFormOtp', component: PreFormOtp },
  { path: '/step-1', name: 'stepOne', component: FormStepOne },
  { path: '/step-2', name: 'stepTwo', component: FormStepTwo },
  { path: '/step-3', name: 'stepThree', component: FormStepThree },
  { path: '/step-4', name: 'stepFour', component: FormStepFour },
  { path: '/complete', name: 'postForm', component: PostForm }
];

let router = new VueRouter({
  mode: 'hash',
  routes,
  store,
  scrollBehavior(to, from, savedPosition) {
    return { x: 0, y: 0 }
  }
});

new Vue({
  el: "#app",
  router,
  store,
  render: h => h(VueOpenAccount)
})