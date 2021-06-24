const state = {
  fields: {
    full_name: "",
    nationality: "INDONESIAN",
    id_type: "KTP",
    ktp_number: "",
    passport_number: "",
    id_valid_date: "",
    id_valid_month: "",
    id_valid_year: "",
    id_valid_lifetime: false,
    email: "",
    mother_name: ""
  },
  step: 1,
  success: false,
  errors: {}
};

const getters = {
  fields: (state) => state.fields,
  step: (state) => state.step,
  success: (state) => state.success,
  errors: (state) => state.errors
};

const mutations = {
  // synchronous
  decreaseStep(state, payload) {
    state.step -= payload;
  },
  increaseStep(state, payload) {
    state.step += payload;
  },
  setSuccess(state, payload) {
    state.success = payload;
  },
  setErrors(state, payload) {
    state.errors = payload;
  },
  UPDATE_FIELD(state, payload) {
    Object.keys(payload).forEach(key => {
      state.fields[key] = payload[key]
    })
  },
};

const actions = {
  // asynchronous
};

export default {
  state,
  getters,
  actions,
  mutations,
}