<template>
    <v-container fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="10" md="4">
                <v-card class="elevation-5">
                    <v-card-title>
                        Login form
                    </v-card-title>

                    <v-card-text>
                        <v-form>

                            <v-alert v-if="this.errors != ''" color="red" class="mb-4" dark>
                                ERRORES
                                {{ this.errors }}
                            </v-alert>

                            <v-text-field v-model="email" label="Email" :error-messages="errors.email" required>
                            </v-text-field>

                            <v-text-field v-model="password" label="Password" type="password"
                                :error-messages="errors.password" required>
                            </v-text-field>

                            <v-btn color="primary" class="mr-4" @click="login">
                                <v-icon left>mdi-login</v-icon>
                                Login
                            </v-btn>

                        </v-form>

                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import AuthService from '../../../services/auth'

export default {
    data() {
        return {
            email: '',
            password: '',
            errors: ''
        };
    },
    methods: {
        async login() {
            await AuthService.login({
                email: this.email,
                password: this.password,
            })
                .then(response => {
                    if (response.data.success) {
                        const token = response.data.data.token;
                        this.$store.dispatch('auth/saveToken', token)
                        this.$router.push({ name: 'Index' })

                    }
                    else {
                        this.errors = response.data.message;
                    }

                })
                .catch(error => {
                    this.errors = error.response.data.message
                });
        },
    }
};
</script>
