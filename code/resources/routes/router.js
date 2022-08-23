import { createWebHistory, createRouter } from "vue-router";

//All Routes 
import publicRoutes from './routes/public'

var routes = publicRoutes;

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router
