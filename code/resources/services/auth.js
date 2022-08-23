import axios from "axios";

let params = {
    withCredentials: false,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
}

let token;
if (token = localStorage.getItem('access_token')) {
    params.headers.Authorization = 'Bearer ' + token
}

const apiClient = axios.create(params)

export default {
    login(credentials) {
        return apiClient.post('/api/login', {
            email: credentials.email,
            password: credentials.password,
        })
    },

    logout() {
        return apiClient.post('/api/logout')
    },

    register(data) {
        return apiClient.post('/api/register', {
            name: data.name,
            email: data.email,
            password: data.password,
            c_password: data.c_password,
        })
    },

}
