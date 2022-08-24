import ProductServices from '../../services/products'
const state = {
    products: {}
}

const getters = {
    getAllProducts(state) {
        return state.products
    }
};

const mutations = {
    updateProducts(state, products) {
        state.products = products
    }
};

const actions = {
    updateProducts(context, products) {
        context.commit('updateProducts', products)
    },
    deleteProducts(context, product) {
        ProductServices.deleteProduct(product.slug)
    }
}


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
