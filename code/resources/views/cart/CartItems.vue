<template>

    <v-table>
        <thead>
            <tr>
                <th class="text-left">
                    Product
                </th>
                <th class="text-center" width="10%">
                    Quantity
                </th>
                <th class="text-center" width="10%">
                    Unit Price
                </th>

                <th class="text-center" width="10%">
                    Price
                </th>

                <th class="text-left" width="10%">
                    Actions
                </th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="item in items" :key="item.item.id">

                <td>

                    {{ item.item.name }}
                </td>

                <td class="text-right">

                    <v-text-field v-show="isEditable" v-model="item.total" min="1" @input="changeQuantity(item)"
                        hide-details single-line type="number">
                    </v-text-field>

                    <span v-show="!isEditable">
                        {{ item.total }}
                    </span>
                </td>


                <td class="text-right">
                    $ {{ item.item.price }}
                </td>

                <td class="text-right">
                    $ {{ item.item.price * item.total }}
                </td>

                <td>
                    <v-btn class="mr-2" :rounded="0" variant="outlined" size="small"
                        :to="{ name: 'products.show', params: { 'product_slug': item.item.slug } }">
                        <v-icon>mdi-eye</v-icon>
                    </v-btn>

                    <v-btn @click="deleteItem(item)" :rounded="0" variant="outlined" size="small" v-show="isEditable">
                        <v-icon small color="red">
                            mdi-trash-can
                        </v-icon>
                    </v-btn>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right">
                    <p class="font-weight-black">
                        TOTAL
                    </p>
                </td>
                <td class="text-right">
                    <p class="font-weight-black">
                        $ {{ itemsTotalPrice }}
                    </p>
                </td>
            </tr>
        </tfoot>

    </v-table>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    props: [
        'isEditable'
    ],
    computed: {
        ...mapGetters({
            items: 'cart/getAllItems',
            itemsTotalPrice: 'cart/getItemsTotalPrice',
        })
    },
    methods: {
        deleteItem(item) {
            this.$store.dispatch('cart/delItem', item.item.id)
        },
        changeQuantity(item) {
            this.$store.dispatch('cart/setQuantityToCart', {
                item: item,
                total: item.total

            })
        },
    }
}
</script>