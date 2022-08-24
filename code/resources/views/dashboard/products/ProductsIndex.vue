<template>
    <v-container fluid>
        <v-row>
            <v-col sm="10">
                <h3 class="title">Products</h3>
            </v-col>
            <v-col sm="2" align="right">
                <v-btn class="mx-2" :rounded="0" color="success" :to="{ name: 'products.list' }">
                    <v-icon dark>mdi-format-list-bulleted</v-icon>
                </v-btn>
                <v-btn class="mx-2" :rounded="0" color="success" :to="{ name: 'product.add' }">
                    <v-icon dark>mdi-plus</v-icon>
                </v-btn>
            </v-col>
        </v-row>

        <v-row>
            <router-view name="content" />
        </v-row>

    </v-container>
</template>
<script>
export default {
    data() {
        return {

        }
    }
}
</script>
