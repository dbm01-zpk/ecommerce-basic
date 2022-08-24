import UserServices from '../../services/users'
const state = {
    users: {}
}

const getters = {
    getAllUsers(state) {
        return state.users
    }
};

const mutations = {
    updateUsers(state, users) {
        state.users = users
    }
};

const actions = {
    updateUsers(context, users) {
        context.commit('updateUsers', users)
    },
    deleteUsers(context, user) {
        UserServices.deleteUser(user.id)
    }
}


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
