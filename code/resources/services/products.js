import ApiBase from "./ApiBase";

export default {
    getProducts(page) {
        return ApiBase().get('/api/products?page=' + page)
    },

    getProduct(id) {
        return ApiBase().get('/api/products/' + id)
    },

    saveProduct(data) {
        return ApiBase().post('/api/products', data)
    },

    updateProduct(data, id) {
        return ApiBase().put('/api/products/' + id, data)
    },

    deleteProduct(id) {
        return ApiBase().delete('/api/products/' + id)
    }
    
}
