
import ProductsIndex from '../../views/dashboard/products/ProductsIndex.vue'
import ProductAdd from '../../views/dashboard/products/ProductAdd.vue'
import ProductEdit from '../../views/dashboard/products/ProductEdit.vue'
import ProductsList from '../../views/dashboard/products/ProductsList.vue'
import UsersIndex from '../../views/dashboard/users/UsersIndex.vue'
import UsersList from '../../views/dashboard/users/UserList.vue'
import UserEdit from '../../views/dashboard/users/UserEdit.vue'
import UserAdd from '../../views/dashboard/users/UserAdd.vue'

export default [

    {
        path: '/admin/',
        component: UsersIndex,
        name: 'admin',
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/admin/products',
        component: ProductsIndex,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: 'add',
                name: 'product.add',
                components: {
                    content: ProductAdd
                },
            },
            {
                path: 'edit/:product_slug',
                name: 'product.edit',
                components: {
                    content: ProductEdit
                },
            },
            {
                path: '',
                name: 'products.list',
                components: {
                    content: ProductsList
                },
            }
        ]
    },
    {
        path: '/admin/users',
        component: UsersIndex,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: 'add',
                name: 'user.add',
                components: {
                    content: UserAdd
                },
            },
            {
                path: 'edit/:user_id',
                name: 'user.edit',
                components: {
                    content: UserEdit
                },
            },
            {
                path: '',
                name: 'users.list',
                components: {
                    content: UsersList
                },
            }
        ]
    },

]
