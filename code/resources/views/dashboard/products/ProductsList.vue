<template>
    <v-container fluid>
        <v-row>

            <v-col cols="12" v-for="product in products" :key="product.id">
                <v-card>
                    <v-row>
                        <v-col sm="2" aling="center" justify="center">
                            <v-avatar size="150" rounded="0">
                                <v-img src="/images/item.png"></v-img>
                            </v-avatar>
                        </v-col>
                        <v-col sm="10">

                            <v-card-title class="text-h5">
                                {{ product.name }}
                            </v-card-title>
                            <hr>

                            <v-card-title>
                                PRICE: $ {{ product.price }}
                            </v-card-title>
                            <v-card-subtitle>
                                {{ product.description }}
                            </v-card-subtitle>

                            <v-card-actions>
                                <v-list-item class="grow">
                                    <v-row>
                                        <v-btn class="ml-2" variant="outlined" size="small"
                                            :to="{ name: 'products.show', params: { 'product_slug': product.slug } }">
                                            <v-icon>mdi-eye</v-icon>
                                            View
                                        </v-btn>

                                        <v-btn class="ml-2" variant="outlined" size="small"
                                            @click="addToCart(product.id)">
                                            <v-icon>mdi-cart</v-icon>
                                            Add to Cart
                                        </v-btn>

                                        <v-btn class="ml-2" variant="outlined" size="small"
                                            :to="{ name: 'product.edit', params: { 'product_slug': product.slug } }"
                                            v-if="loggedIn">
                                            <v-icon>mdi-circle-edit-outline</v-icon>
                                            Edit
                                        </v-btn>

                                        <v-btn class="ml-2" variant="outlined" size="small" color="red"
                                            @click="deleteProduct(product.id)" v-if="loggedIn">
                                            <v-icon>mdi-trash-can</v-icon>
                                            Delete
                                        </v-btn>
                                    </v-row>
                                </v-list-item>



                            </v-card-actions>

                        </v-col>
                    </v-row>
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
import { mapGetters } from 'vuex'

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
    computed: {
        ...mapGetters(
            {
                loggedIn: 'auth/loggedIn',
            })
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
        },
        deleteProduct(id) {
            let product = this.products.find(item => item.id === id);
            this.$swal({
                title: 'Confirm delete product?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: `Don't delete`,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$store.dispatch('products/deleteProducts', product);
                    this.$swal(
                        'Success!',
                        'Product deleted!',
                        'success'
                    ).then((result) => {
                        this.getAllProducts()
                    })
                }
                else {
                    this.$swal(
                        'Cancelled',
                        'Action cancelled!',
                        'error'
                    )
                }
            });
        }
    }
}
</script>

