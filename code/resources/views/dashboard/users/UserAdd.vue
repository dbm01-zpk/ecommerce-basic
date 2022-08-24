<template>
    <v-container fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="10" md="4">
                <v-card class="elevation-5">
                    <v-card-title>
                        Add user
                    </v-card-title>

                    <v-card-text>
                        <v-form>

                            <v-text-field v-model="name" label="Name" :error-messages="errors.name" required>
                            </v-text-field>

                            <v-text-field v-model="email" label="Email" :error-messages="errors.email" required>
                            </v-text-field>

                            <v-text-field v-model="password" label="Password" type="password"
                                :error-messages="errors.password" required>
                            </v-text-field>

                            <v-text-field v-model="c_password" label="Password confirmation" type="password"
                                :error-messages="errors.c_password" required>
                            </v-text-field>

                            <v-btn color="primary" class="mr-4" @click="saveUser">
                                <v-icon left>mdi-circle-edit-outline</v-icon>
                                Save user
                            </v-btn>

                            <v-btn color="error" class="mr-4" :to="{ name: 'users.list' }">
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
        async saveUser() {
            await AuthService.register({
                name: this.name,
                email: this.email,
                password: this.password,
                c_password: this.c_password,
            })
                .then(token => {
                    this.$swal(
                        'Success!!!',
                        'The user was successfully register!',
                        'success'
                    ).then(() => {
                        this.$router.push({ name: 'users.list' })
                    });
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                });
        }
    }
};
</script>
