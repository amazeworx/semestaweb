let mutations = {
  setFullName(state, value) {
    state.fullName = value
  },
  SET_FIELD(state, payload) {
    state.posts = payload
  },
  CREATE_POST(state, post) {
    state.posts.unshift(post)
  },
  FETCH_POSTS(state, posts) {
    return state.posts = posts
  },
  DELETE_POST(state, post) {
    let index = state.posts.findIndex(item => item.id === post.id)
    state.posts.splice(index, 1)
  }

}
export default mutations