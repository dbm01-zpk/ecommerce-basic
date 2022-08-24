<template>
    <v-container fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="10" md="4">
                <v-card class="elevation-5">
                    <v-card-title>
                        Add products
                    </v-card-title>

                    <v-card-text>
                        <v-form>

                            <v-alert v-if="this.errors != ''" color="red" class="mb-4" dark>
                                ERRORES
                                Check the errors on form
                            </v-alert>

                            <v-text-field v-model="product.name" label="Name" :error-messages="errors.name" required>
                            </v-text-field>

                            <v-textarea v-model="product.description" label="Description"
                                :error-messages="errors.description" required></v-textarea>

                            <v-text-field v-model="product.price" label="Price" :error-messages="errors.price" required>
                            </v-text-field>

                            <v-btn color="primary" class="mr-4" @click="saveProduct">
                                <v-icon left>mdi-content-save</v-icon>
                                Add product
                            </v-btn>

                            <v-btn color="error" class="mr-4" :to="{ name: 'products.list' }">
                                <v-icon left>mdi-cancel</v-icon>
                                Cancelar
                            </v-btn>

                        </v-form>

                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import ProductServices from '../../../services/products'

export default {
    data() {
        return {
            errors: '',
            product: {
                name: '',
                description: '',
                price: ''
            }
        }
    },
    methods: {
        async saveProduct() {
            await ProductServices.saveProduct(this.product)
                .then(response => {
                    this.$swal(
                        'Success!!!',
                        'The product was successfully added!',
                        'success'
                    ).then(() => {
                        this.$router.push({ name: 'products.list' })
                    });
                })
                .catch(errors => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>

