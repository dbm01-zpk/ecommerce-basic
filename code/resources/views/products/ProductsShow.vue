<template>
    <v-container fluid>

        <v-row>
            <v-col sm="12" md="1" offset-md="2">
                <v-img src="/images/item.png"></v-img>
            </v-col>

            <v-col sm="12" md="5">
                <h1>{{ product.name }}</h1>
                <h3>$ {{ product.price }}</h3>
                <hr>
                <p>{{ product.description }}</p>

                <v-btn class="ml-2" variant="outlined" @click="addToCart">
                    <v-icon>mdi-cart-arrow-down</v-icon>
                    Add to Cart
                </v-btn>

                <v-btn class="ml-2" variant="outlined" :to="{ name: 'cart' }">
                    <v-icon>mdi-cart</v-icon>
                    Go to Cart
                </v-btn>

                <v-btn color="success ml-2" :to="{ name: 'Index' }">
                    <v-icon>mdi-keyboard-backspace</v-icon>
                    Products
                </v-btn>

            </v-col>
        </v-row>


    </v-container>
</template>

<script>

import ProductServices from '../../services/products'

export default {
    data() {
        return {
            errors: {},
            product: {}
        }
    },
    mounted() {
        this.getProduct()
    }, methods: {
        async getProduct() {
            let product_slug = this.$route.params.product_slug
            await ProductServices.getProduct(product_slug)
                .then(response => {
                    this.product = response.data.data
                })
        },
        addToCart() {
            this.$store.dispatch(
                'cart/addToCart',
                this.product
            );
        }
    }
}
</script>