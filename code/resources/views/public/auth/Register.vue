<template>
    <v-container fluid>
        <v-row
            align="center"
            justify="center">
            <v-col
                cols="12"
                sm="10"
                md="4"
                >
                <v-card class="elevation-5">
                    <v-card-title>
                        Register form
                    </v-card-title>

                    <v-card-text>
                        <v-form>

                            <v-text-field
                                v-model="name"
                                label="Name"
                                :error-messages="errors.name"
                                required>
                            </v-text-field>

                            <v-text-field
                                v-model="email"
                                label="Email"
                                :error-messages="errors.email"
                                required>
                            </v-text-field>

                            <v-text-field
                                v-model="password"
                                label="Password"
                                type="password"
                                :error-messages="errors.password"
                                required>
                            </v-text-field>

                            <v-text-field
                                v-model="c_password"
                                label="Password confirmation"
                                type="password"
                                :error-messages="errors.c_password"
                                required>
                            </v-text-field>

                            <v-btn
                                color="primary"
                                class="mr-4"
                                @click="register">
                                    <v-icon left>mdi-account-plus-outline</v-icon>
                                    Register me
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
    data: () => ({
        name: '',
        email: '',
        username: '',
        password: '',
        c_password: '',
        errors: {}
    }),
    methods: {
        async register() {
            await AuthService.register({
                name: this.name,
                email: this.email,
                password: this.password,
                c_password: this.c_password,
            })
                .then(token => {
                    this.$swal(
                        'Welcome to E-Commerce',
                        'Registered!!!',
                        'success'
                    ).then(() => {
                        this.$router.push({ name: 'login' })
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                });
        }
    }
};
</script>
