let actions = {
  resetFormState({ commit }) {
    commit('RESET_STATE')
  },
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
  requestOtp({ commit }, post) {
    //console.log(post);
    return new Promise((resolve, reject) => {
      axios.post('/api/otp/request', post).then(res => {
        resolve(res.data);
      }, error => {
        reject(err);
      })
    });
  },
  resendOtp({ commit }, post) {
    //console.log(post);
    return new Promise((resolve, reject) => {
      axios.post('/api/otp/resend', post).then(res => {
        resolve(res.data);
      }, error => {
        reject(err);
      })
    });
  },
  validateOtp({ commit }, post) {
    //console.log(post);
    return new Promise((resolve, reject) => {
      axios.post('/api/otp/validate', post).then(res => {
        resolve(res.data);
      }, error => {
        reject(err);
      })
    });
  },
  createLead({ commit }, post) {
    //console.log(post);
    return new Promise((resolve, reject) => {
      axios.post('/api/lead', post).then(res => {
        resolve(res.data);
      }, error => {
        reject(err);
      })
    });
  },
  createDraftAccount({ commit }, post) {
    //console.log(post);
    return new Promise((resolve, reject) => {
      axios.post('/api/vue-open-account/draft', post).then(res => {
        resolve(res.data);
      }, error => {
        reject(err);
      })
    });
  },
  updateDraftAccount({ commit }, post) {
    //console.log(post);
    return new Promise((resolve, reject) => {
      axios.post('/api/vue-open-account/update', post).then(res => {
        resolve(res.data);
      }, error => {
        reject(err);
      })
    });
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