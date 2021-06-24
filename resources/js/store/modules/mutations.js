let mutations = {
  // synchronous
  // decreaseStep(state, payload) {
  //   state.step -= payload;
  // },
  // increaseStep(state, payload) {
  //   state.step += payload;
  // },
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