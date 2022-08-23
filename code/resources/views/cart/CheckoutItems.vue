<template>
    <v-container fluid>

        <v-row align="center" justify="center">
            <h3>CHECKOUT </h3>
        </v-row>

        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-title>
                        1 - CHECK ITEMS IN YOUR CART
                    </v-card-title>
                    <CartItems :isEditable=false></CartItems>

                </v-card>
            </v-col>
        </v-row>

        <v-form v-model="valid" v-if="items.length" ref="form">
            <v-row>

                <v-col cols="12" md="6">
                    <v-card>
                        <v-card-title>
                            2 - BILLING INFORMATION
                        </v-card-title>
                        <v-card-text>

                            <v-container>
                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-text-field v-model="firstname" :rules="basicRules" label="First name">
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field v-model="lastname" :rules="basicRules" label="Last name">
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field v-model="email" :rules="emailRules" label="E-mail">
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field v-model="phone" :rules="basicRules" label="Phone number">
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field v-model="country" :rules="basicRules" label="Country">
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="6">
                                        <v-text-field v-model="state" :rules="basicRules" label="State">
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="4">
                                        <v-text-field v-model="zip_code" :counter="5" :rules="basicRules"
                                            label="ZIP CODE">
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="8">
                                        <v-text-field v-model="city" :rules="basicRules" label="City">
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12">
                                        <v-text-field v-model="address" :rules="basicRules" label="Address">
                                        </v-text-field>
                                    </v-col>

                                </v-row>
                            </v-container>

                        </v-card-text>
                    </v-card>
                </v-col>

                <v-col cols="12" md="6">
                    <v-card>
                        <v-card-title>
                            3 - PAYMENT INFORMATION
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" md="12">
                                        <v-text-field v-model="card_number" :rules="cardNumberRules" label="Card number"
                                            required>
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="12" md="4">
                                        <v-select :items="card_exp_month" :rules="basicRules" label="EXP. MONTH">
                                        </v-select>
                                    </v-col>

                                    <v-col cols="12" md="4">
                                        <v-select :items="card_exp_year" :rules="basicRules" label="EXP. YEAR">
                                        </v-select>


                                    </v-col>

                                    <v-col cols="12" md="4">
                                        <v-text-field v-model="card_cvv" :rules="cvvRules" :counter="3" label="CVV CODE"
                                            required></v-text-field>
                                    </v-col>


                                </v-row>

                                <v-btn color="primary" class="mr-4 text-center" @click="pay">
                                    PAY
                                </v-btn>

                            </v-container>

                        </v-card-text>
                    </v-card>
                </v-col>

            </v-row>
        </v-form>

        <v-row align="center" v-if="!items.length" justify="center">
            <v-col cols="12" sm="12" md="10">
                <v-alert align="center">
                    You don't have products added to your cart
                </v-alert>

                <v-btn color="success" :to="{ name: 'Index' }">Go to products</v-btn>
            </v-col>

        </v-row>

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
            items: 'cart/getAllItems',
        })
    },
    methods: {
        async pay() {
            let formValid = await this.$refs.form.validate();
            if (formValid.valid) {
                this.$swal({
                    title: 'Confirm pay?',
                    showDenyButton: true,
                    confirmButtonText: 'Pay',
                    denyButtonText: `Don't pay`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.$store.dispatch('cart/checkout');
                        this.$swal(
                            'Good job!',
                            'Pay ready!',
                            'success'
                        ).then((result) => {
                            this.$router.push({ name: 'Index' })
                        })
                    }
                    else {
                        this.$swal(
                            'Cancelled',
                            'Pay cancelled!',
                            'error'
                        )
                    }
                });
            }

        }
    },
    data: () => ({
        valid: true,
        firstname: '',
        lastname: '',
        email: '',
        phone: '',
        country: '',
        state: '',
        zip_code: '',
        city: '',
        address: '',
        card_number: '',
        card_exp_month: Array.from({ length: 12 }, (_, i) => i + 1),
        card_exp_year: Array.from({ length: 22 }, (_, i) => i + 2022),
        card_cvv: '',
        basicRules: [
            v => !!v || 'Is required',
        ],
        cvvRules: [
            v => !!v || 'CVV is required',
            v => /\d{3}/.test(v) || 'CVV is invalid',
        ],
        cardNumberRules: [
            v => !!v || 'Card is required',
            v => /\d{16}/.test(v) || 'Card Number is invalid',
        ],
        emailRules: [
            v => !!v || 'E-mail is required',
            v => /.+@.+/.test(v) || 'E-mail must be valid',
        ],

    }),
}
</script>