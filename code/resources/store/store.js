import { createStore } from 'vuex'

import products from './modules/products'
import cart from './modules/cart'
import auth from './modules/auth'
import users from './modules/users'

export const store = createStore({
  modules: {
    products,
    cart,
    auth,
    users
  }
})

export default store
