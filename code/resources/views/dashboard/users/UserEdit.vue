<template>
    <v-container fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="10" md="4">
                <v-card class="elevation-5">
                    <v-card-title>
                        Edit user
                    </v-card-title>

                    <v-card-text>
                        <v-form>

                            <v-alert v-if="this.errors != ''" color="red" class="mb-4" dark>
                                ERRORES
                                Check the errors on form
                            </v-alert>

                            <v-text-field v-model="user.name" label="Name" :error-messages="errors.name" required>
                            </v-text-field>

                            <v-text-field v-model="user.password" label="Password" type="password"
                                :error-messages="errors.password" required>
                            </v-text-field>

                            <v-text-field v-model="user.c_password" label="Password confirmation" type="password"
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
import UserServices from '../../../services/users'

export default {
    data() {
        return {
            errors: '',
            user: {
                name: '',
                email: '',
                username: '',
                password: '',
                c_password: '',
            }
        }
    },
    mounted() {
        this.getUser()
    },
    methods: {
        async getUser() {
            let user_id = this.$route.params.user_id
            await UserServices.getUser(user_id)
                .then(response => {
                    this.user = response.data.data;
                })
        },
        async saveUser() {
            let user_id = this.$route.params.user_id
            await UserServices.updateUser(user_id, this.user)
                .then(response => {
                    this.$swal(
                        'Success!!!',
                        'The user was successfully updated!',
                        'success'
                    ).then(() => {
                        this.$router.push({ name: 'users.list' })
                    });
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                })
        },
    }
}
</script>

