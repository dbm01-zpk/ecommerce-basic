const state = {
    items: JSON.parse(localStorage.getItem('cart-items')) || []
}

const getters = {
    getAllItems(state) {
        /**
         * Get all products on cart
         */
        return state.items;
    },
    getItemsTotal(state) {
        /**
         * Quantity of all items on cart
         */
        return state.items.reduce((acc, current) => {
            let total = parseInt(current.total || 0);
            return acc + total;
        }, 0);
    },
    getItemsTotalPrice(state) {
        /**
         * Total price of cart
         */
        let total = state.items.reduce((acc, current) => {
            let total = parseInt(current.total || 0);
            return acc + (total * current.item.price);
        }, 0);

        return parseFloat(total).toFixed(2);
    }
};

const mutations = {
    addToCart(state, item, quantity = 1) {
        state.items.push({
            item: item,
            total: quantity,
            total_price: parseFloat(quantity * item.price).toFixed(2)
        });
    },
    incItemTotal(state, id) {
        const cartItem = state.items.find(item => item.item.id === id);
        cartItem.total++;
    },
    setItemTotal(state, itemParam) {
        /**
         * Update quantity of items
         */

        // get params
        const id = itemParam.item;
        const quantity = itemParam.total;

        // find item to update && set values
        const cartItem = state.items.find(item => item.item.id === id);
        cartItem.total = quantity;
        cartItem.total_price = parseFloat(quantity * cartItem.item.price).toFixed(2);
    },
    delItem(state, delItem) {
        state.items.find(function (value, index) {
            if (value) {
                if (value.item.id === delItem) {
                    state.items.splice(index, 1);
                }
            }
        })
    },
    checkout(state) {
        /**
         * After checkout, clean products
         */
        state.items = [];
    },
};

const actions = {
    addToCart(context, itemToAdd) {
        /**
         * Add item to cart
         * if exists the same item; increment quantity;
         */
        const cartItem = state.items.find(item => item.item.id === itemToAdd.id);

        if (!cartItem) {
            context.commit('addToCart', itemToAdd);
        } else {
            context.commit('incItemTotal', cartItem.item.id);
        }

        context.dispatch('localStoreCart');
    },
    setQuantityToCart(context, itemParam) {
        /**
         * Update(+ or -) quantity of one item
         * if not exists, push to cart.
         */
        let itemToAdd = itemParam.item;
        let total = itemParam.total;

        const cartItem = state.items.find(item => item.item.id === itemToAdd.item.id);

        if (!cartItem) {
            context.commit('addToCart', itemToAdd, total);
        } else {
            context.commit('setItemTotal', {
                item: cartItem.item.id,
                total: total
            });
        }

        context.dispatch('localStoreCart');
    },

    delItem(context, delItem) {
        context.commit('delItem', delItem);
        context.dispatch('localStoreCart');
    },
    checkout(context) {
        context.commit('checkout');
        context.dispatch('localStoreCart');
    },
    localStoreCart(context) {
        localStorage.setItem('cart-items', JSON.stringify(context.state.items));
    },
}


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
