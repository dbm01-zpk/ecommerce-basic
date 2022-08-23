
const state = {
  token: localStorage.getItem('access_token') || null,
  user : {}
}

const getters = {
    loggedIn(state) {
        return state.token !== null;
    }
};

const mutations = {
    authSuccess(state, token) {
        state.token = token;
    },
    destroyToken(state) {
        state.token = null;
        state.user = {};
    }
};

const actions = {
    saveToken(context, token) {
        localStorage.setItem('access_token', token);
        context.commit('authSuccess', token);
    },
    destroyToken(context, token) {
        localStorage.removeItem('access_token');
        context.commit('destroyToken', token);
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
