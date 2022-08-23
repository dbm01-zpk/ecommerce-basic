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
                <v-list-item-icon>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-icon>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item>

            <!-- If user is logged in -->
            <v-list-subheader>Dashboard</v-list-subheader>
            <v-list-subheader>Auth</v-list-subheader>

            <v-list-item :to="{ name: 'Index' }">
                <v-list-item-icon>
                    <v-icon>mdi-account-plus</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Register</v-list-item-title>
            </v-list-item>

            <v-list-item :to="{ name: 'Index' }">
                <v-list-item-icon>
                    <v-icon>mdi-login</v-icon>
                </v-list-item-icon>

                <v-list-item-title>Login</v-list-item-title>
            </v-list-item>

        </v-list>
    </v-navigation-drawer>

</template>

<script>

import { mapGetters } from 'vuex'
export default {
    data: () => ({
        drawer: false,
        group: null,
        items: [
            {
                title: 'Products',
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
                itemsQuantity: 'cart/getItemsTotal'
            })
    },
    methods: {
        menuActionClick(value) {
            this.$router.push({ name: value })
        }
    }
}
</script>
