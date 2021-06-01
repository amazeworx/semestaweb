require("./bootstrap");
require("alpinejs");

import Vue from "vue";
import vuetify from './plugins/vuetify';
import vSelect from 'vue-select';
import store from './store'
Vue.mixin(require('./trans'));

Vue.component('v-select', vSelect);
Vue.component(
  "form-open-account",
  require("./components/FormOpenAccount.vue").default
);

Vue.component(
  "open-account",
  require("./components/OpenAccount.vue").default
);

// new Vue({
//   vuetify,
// }).$mount('#app')

new Vue({
  el: '#app',
  store,
})