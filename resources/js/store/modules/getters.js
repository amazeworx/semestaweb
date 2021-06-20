let getters = {
  // posts: state => {
  //   return state.posts
  // }
  fullName: {
    get() {
      return this.$store.state.fullName
    },
    set(value) {
      this.$store.commit('setFullName', value)
    }
    //return state.posts.fullName;
  }
}

export default getters