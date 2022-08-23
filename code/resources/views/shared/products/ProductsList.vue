<template>
    <v-container fluid>
        <v-row>

            <v-col lg="4" md="6" xs="12" v-for="product in products" :key="product.id">
                <v-card>
                    <div class="d-flex flex-no-wrap justify-space-between">
                        <div>
                            <v-card-title class="text-h5">
                                {{ product.name }}
                            </v-card-title>

                            <hr>

                            <v-card-subtitle>
                                {{ product.description }}
                            </v-card-subtitle>

                            <v-card-actions>
                                <v-chip color="success">$ {{ product.price }}</v-chip>

                                <v-btn class="ml-2" variant="outlined" size="small"
                                    :to="{ name: 'products.show', params: { 'product_slug': product.slug } }">
                                    <v-icon>mdi-eye</v-icon>
                                    View
                                </v-btn>
                                <v-btn class="ml-2" variant="outlined" size="small" @click="addToCart(product.id)">
                                    <v-icon>mdi-cart</v-icon>
                                    Add to Cart
                                </v-btn>
                            </v-card-actions>
                        </div>

                        <v-avatar class="ma-3" size="125" rounded="0">
                            <v-img src="/images/item.png"></v-img>
                        </v-avatar>
                    </div>
                </v-card>
            </v-col>

        </v-row>

        <v-row align="center" justify="center" v-if="!totalItems">
            <v-col cols="12">
                <v-alert align="center">
                    Products list empty
                </v-alert>
            </v-col>
        </v-row>

        <v-row>
            <v-pagination v-if="totalItems" v-model="page" :length="total" total-visible="7" @click="getAllProducts">
            </v-pagination>
        </v-row>

        <v-snackbar :timeout="snackbar.timeout" v-model="snackbar.status" vertical>
            <div class="text-subtitle-1 pb-2">
                <v-icon>mdi-cart</v-icon>
                Cart
            </div>

            {{ snackbar.text }}

            <template v-slot:actions>
                <v-btn variant="text" @click="snackbar.status = false">
                    Close
                </v-btn>
            </template>
        </v-snackbar>

    </v-container>
</template>

<script>

import ProductServices from '../../../services/products'

export default {
    data() {
        return {
            products: {},
            page: 1,
            totalItems: 0,
            total: 0,
            snackbar: {
                status: false,
                timeout: 2000,
                text: ''
            }

        }
    },
    mounted() {
        this.getAllProducts()
    },
    methods: {
        async getAllProducts() {
            let products = await ProductServices.getProducts(this.page);
            let meta = products.data.meta;
            this.$store.dispatch('products/updateProducts', products.data);
            let response = await this.$store.getters['products/getAllProducts'];

            this.products = response.data;
            this.total = meta.last_page;
            this.totalItems = meta.total;
        },
        addToCart(id) {
            let product = this.products.find(item => item.id === id);

            this.snackbar.text = `You added ${product.name} to your cart`;
            this.snackbar.status = true;
            this.$store.dispatch(
                'cart/addToCart',
                product
            );
        }
    }
}
</script>