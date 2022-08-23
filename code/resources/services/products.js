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
    getProducts(page) {
        return apiClient.get('/api/products?page=' + page)
    },

    getProduct(id) {
        return apiClient.get('/api/products/' + id)
    },

    saveProduct(data) {
        return apiClient.post('/api/products', data)
    },

    updateProduct(data, id) {
        return apiClient.put('/api/products/' + id, data)
    },

    deleteProduct(id) {
        return apiClient.delete('/api/products/' + id)
    }
}
