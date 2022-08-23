<template>
    <v-container fluid>

        <v-row>
            <v-col align="center" justify="center">
                <h1>ITEMS: {{ itemsTotal }}</h1>
            </v-col>
            <v-col align="center" justify="center">
                <h1>TOTAL PRICE: $ {{ itemsTotalPrice }}</h1>
            </v-col>
            <v-col align="center" justify="center">
                <v-btn :to="{ name: 'checkout' }">Checkout</v-btn>
            </v-col>

        </v-row>

        <CartItems :isEditable=true></CartItems>

    </v-container>
</template>

<script>
import { mapGetters } from 'vuex'
import CartItems from './CartItems.vue'

export default {
    components: {
        CartItems,
    },
    computed: {
        ...mapGetters({
            itemsTotal: 'cart/getItemsTotal',
            itemsTotalPrice: 'cart/getItemsTotalPrice',
        })
    }
}
</script>