<template>
    <v-app-bar color="primary" elevate-on-scroll>

        <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

        <v-toolbar-title>
            <v-btn :to="{ name: 'Index' }">E-Commerce</v-btn>
        </v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn :to="{ name: 'cart' }">
            <v-icon>mdi-cart</v-icon>
            Cart items ( {{ itemsQuantity }} )
        </v-btn>

    </v-app-bar>

    <v-navigation-drawer v-model="drawer" bottom temporary>
        <v-list>
            <!-- Public -->
            <v-list-subheader>E-Commerce</v-list-subheader>
            <v-list-item v-for="item in items" :key="item.value" v-on:click="menuActionClick(item.value)">
                <v-icon>{{ item.icon }}</v-icon>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item>

            <!-- If user is logged in -->
            <v-list-subheader v-if="loggedIn">Dashboard</v-list-subheader>
            <v-list-item :to="{ name: 'products.list' }" v-if="loggedIn">
                <v-icon>mdi-package-variant</v-icon>
                <v-list-item-title>Products</v-list-item-title>
            </v-list-item>
            <v-list-item :to="{ name: 'users.list' }" v-if="loggedIn">
                <v-icon>mdi-account</v-icon>
                <v-list-item-title>Users</v-list-item-title>
            </v-list-item>

            <v-list-subheader>Auth</v-list-subheader>

            <v-list-item :to="{ name: 'register' }" v-if="!loggedIn">
                <v-icon>mdi-account-plus</v-icon>
                <v-list-item-title>Register</v-list-item-title>
            </v-list-item>

            <v-list-item :to="{ name: 'login' }" v-if="!loggedIn">
                <v-icon>mdi-login</v-icon>
                <v-list-item-title>Login</v-list-item-title>
            </v-list-item>

            <v-list-item v-on:click="logout" v-if="loggedIn">
                <v-icon>mdi-exit-run</v-icon>
                <v-list-item-title>Logout</v-list-item-title>
            </v-list-item>

        </v-list>
    </v-navigation-drawer>

</template>

<script>

import { mapGetters } from 'vuex'
import AuthService from '../../services/auth'
export default {
    data: () => ({
        drawer: false,
        group: null,
        items: [
            {
                title: 'Catalog',
                icon: 'mdi-package-variant',
                value: 'Index',
            },
            {
                title: 'Cart',
                icon: 'mdi-cart',
                value: 'cart',
            },
            {
                title: 'Checkout',
                icon: 'mdi-currency-usd',
                value: 'checkout',
            },
        ],
    }),
    watch: {
        group() {
            this.drawer = false
        },
    },
    computed: {
        ...mapGetters(
            {
                itemsQuantity: 'cart/getItemsTotal',
                loggedIn: 'auth/loggedIn',
            })
    },
    methods: {
        menuActionClick(value) {
            this.$router.push({ name: value })
        },
        logout() {
            AuthService.logout()
                .then(response => {
                    this.$store.dispatch('auth/destroyToken')

                    this.$swal(
                        'Logout',
                        'See you soon!!!',
                        'success'
                    ).then(() => {
                        this.$router.push({ name: "Index" })
                    });

                });
        }
    }
}
</script>
