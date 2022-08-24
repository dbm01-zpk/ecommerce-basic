import ApiBase from "./ApiBase";

export default {
    getUsers(page) {
        return ApiBase().get('/api/users?page=' + page)
    },

    getUser(id) {
        return ApiBase().get('/api/users/' + id)
    },

    saveUser(data) {
        return ApiBase().post('/api/users', data)
    },

    updateUser(data, id) {
        return ApiBase().put('/api/users/' + id, data)
    },

    deleteUser(id) {
        return ApiBase().delete('/api/users/' + id)
    }
}
