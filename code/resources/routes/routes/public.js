
import NotFound from '../../views/error/NotFound.vue'
import Index from '../../views/public/Index.vue'
import ProductsShow from '../../views/dashboard/products/ProductsShow.vue'
import Cart from '../../views/cart/CartDetails.vue'
import Checkout from '../../views/cart/CheckoutItems.vue'
import Register from '../../views/public/auth/Register.vue'
import Login from '../../views/public/auth/Login.vue'

export default [
    {
        path: '/',
        component: Index,
        name: 'Index',
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/404',
        name: '404',
        component: NotFound,
    },
    {
        path: '/cart',
        name: 'cart',
        component: Cart,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/products/:product_slug',
        name: 'products.show',
        component: ProductsShow,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/checkout',
        name: 'checkout',
        component: Checkout,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/auth/login',
        name: 'login',
        component: Login,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/auth/register',
        name: 'register',
        component: Register,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: NotFound
    },

]
