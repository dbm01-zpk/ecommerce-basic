<template>

    <v-col sm="12">
        <v-table density="compact">
            <thead>
                <tr>
                    <th class="text-left">
                        User
                    </th>

                    <th class="text-left">
                        Email
                    </th>

                    <th class="text-center">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>
                        {{ user.name }}
                    </td>
                    <td>
                        {{ user.email }}
                    </td>
                    <td class="text-right">
                        <v-btn class="mr-2" :rounded="0" variant="outlined" size="small"
                            :to="{ name: 'user.edit', params: { 'user_id': user.id } }">
                            <v-icon>mdi-circle-edit-outline</v-icon>
                            Edit
                        </v-btn>
                        <v-btn class="mr-2" :rounded="0" variant="outlined" size="small" color="red"
                            @click="deleteUser(user.id)">
                            <v-icon>mdi-trash-can</v-icon>
                            Delete
                        </v-btn>
                    </td>
                </tr>
            </tbody>

        </v-table>
    </v-col>

    <v-col sm="12">
        <v-pagination v-if="totalItems" v-model="page" :length="total" @click="getAllUsers">
        </v-pagination>
    </v-col>

</template>

<script>

import UserServices from '../../../services/users'

export default {
    data() {
        return {
            users: {},
            page: 1,
            totalItems: 0,
            total: 0,

        }
    },
    mounted() {
        this.getAllUsers()
    },

    methods: {
        async getAllUsers() {
            let users = await UserServices.getUsers(this.page);
            let meta = users.data.meta;
            this.$store.dispatch('users/updateUsers', users.data);
            let response = await this.$store.getters['users/getAllUsers'];

            this.users = response.data;
            this.total = meta.last_page;
            this.totalItems = meta.total;

        },
        deleteUser(id) {
            let user = this.users.find(item => item.id === id);
            this.$swal({
                title: 'Confirm delete user?',
                showDenyButton: true,
                confirmButtonText: 'Delete',
                denyButtonText: `Don't delete`,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$store.dispatch('users/deleteUsers', user);
                    this.$swal(
                        'Success!',
                        'User deleted!',
                        'success'
                    ).then((result) => {
                        this.getAllUsers()
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