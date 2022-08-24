import ApiBase from "./ApiBase";

export default {
    login(credentials) {
        return ApiBase().post('/api/login', {
            email: credentials.email,
            password: credentials.password,
        })
    },

    logout() {
        return ApiBase().post('/api/logout')
    },

    register(data) {
        return ApiBase().post('/api/register', {
            name: data.name,
            email: data.email,
            password: data.password,
            c_password: data.c_password,
        })
    },

}
