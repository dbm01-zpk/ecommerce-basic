import store from '../store/store'
import {
    createWebHistory,
    createRouter
} from "vue-router";

//All Routes 
import publicRoutes from './routes/public'
import adminRoutes from './routes/admin'

// Join routes app
var routes = []
    .concat(publicRoutes)
    .concat(adminRoutes);

// Declare router and configure
const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Check if path require logged in
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        
        if (!store.getters["auth/loggedIn"]) {
            // Not logged redirect to Login
            next({ name: 'login' })
        } else {
            // If logged go to path
            next()
        }
    }
    else
    {
        // If dont require auth; go to path
        next() 
    }
})

export default router
