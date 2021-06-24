let actions = {
  createPost({ commit }, post) {
    //console.log(post);
    axios.post('/api/vue-open-account', post)
      .then(res => {
        //console.log(res.data);
        //commit('CREATE_POST', res.data)
      }).catch(err => {
        console.log(err)
      })
  },
  fetchPosts({ commit }) {
    axios.get('/api/vue-open-account')
      .then(res => {
        //commit('FETCH_POSTS', res.data)
      }).catch(err => {
        console.log(err)
      })
  },
  deletePost({ commit }, post) {
    axios.delete(`/api/vue-open-account/${post.id}`)
      .then(res => {
        // if (res.data === 'ok') commit('DELETE_POST', post)
      }).catch(err => {
        console.log(err)
      })
  }
}

export default actions