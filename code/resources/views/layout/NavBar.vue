<template>
    <v-app-bar absolute color="primary" elevate-on-scroll>
        <v-toolbar-title>
            <v-btn :to="{ name: 'Index' }">E-Commerce</v-btn>
        </v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn color="black" :to="{ name: 'cart' }">
            <v-icon color="black">mdi-cart</v-icon>
            Cart items ( {{ itemsQuantity }} )
        </v-btn>

    </v-app-bar>
</template>

<script>

import { mapGetters } from 'vuex'
export default {
    computed: {
        ...mapGetters(
            {
                itemsQuantity: 'cart/getItemsTotal'
            })
    },
}
</script>
