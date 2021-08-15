import { getDefaultState } from './state.js'

let mutations = {
  // synchronous
  decreaseStep(state, payload) {
    state.step -= payload;
  },
  increaseStep(state, payload) {
    state.step += payload;
  },
  SET_STEP(state, payload) {
    state.step = payload;
  },
  SET_DB_LOADED(state, payload) {
    state.db_loaded = payload
  },
  SET_VALIDATED_STEP(state, payload) {
    state.step_validated = payload;
  },
  SET_OTP_SENT(state, payload) {
    state.otp_sent = payload
  },
  SET_OTP_UID(state, payload) {
    state.otp_unique_id = payload
  },
  SET_OTP_RESENDID(state, payload) {
    state.otp_resend_id = payload
  },
  // setSuccess(state, payload) {
  //   state.success = payload;
  // },
  // setErrors(state, payload) {
  //   state.errors = payload;
  // },
  UPDATE_FIELD(state, payload) {
    Object.keys(payload).forEach(key => {
      state.fields[key] = payload[key]
    })
  },
  RESET_STATE(state) {
    Object.assign(state, getDefaultState());
    //console.log("State cleared")
  }
  // CREATE_POST(state, post) {
  //   state.fields.unshift(post)
  // },
  // FETCH_POSTS(state, posts) {
  //   return state.posts = posts
  // },
  // DELETE_POST(state, post) {
  //   let index = state.posts.findIndex(item => item.id === post.id)
  //   state.posts.splice(index, 1)
  // }

}
export default mutations