const state = {
    items: JSON.parse(localStorage.getItem('cart-items')) || []
}

const getters = {
    getAllItems(state) {
        return state.items;
    },
    getItemsTotal(state) {
        return state.items.reduce((acc, current) => {
            let total = parseInt(current.total || 0);
            return acc + total;
        }, 0);
    },
    getItemsTotalPrice(state) {
        let total = state.items.reduce((acc, current) => {
            let total = parseInt(current.total || 0);
            return acc + (total * current.item.price);
        }, 0);

        return parseFloat(total).toFixed(2);
    }
};

const mutations = {
    addToCart(state, item, quantity = 1) {
        state.items.push({ item: item, total: quantity });
    },
    incItemTotal(state, id) {
        const cartItem = state.items.find(item => item.item.id === id);
        cartItem.total++;
    },
    setItemTotal(state, itemParam) {
        const id = itemParam.item;
        const quantity = itemParam.total;
        const cartItem = state.items.find(item => item.item.id === id);
        cartItem.total = quantity;
    },
    delItem(state, delItem) {
        state.items.find(function (value, index) {
            if (value) {
                if (value.item.id === delItem) {
                    state.items.splice(index, 1);
                }
            }
        })
    }
};

const actions = {
    addToCart(context, itemToAdd) {
        const cartItem = state.items.find(item => item.item.id === itemToAdd.id);

        if (!cartItem) {
            context.commit('addToCart', itemToAdd);
        } else {
            context.commit('incItemTotal', cartItem.item.id);
        }

        context.dispatch('localStoreCart');
    },
    setQuantityToCart(context, itemParam) {
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

    localStoreCart(context) {
        localStorage.setItem('cart-items', JSON.stringify(context.state.items));
    },

    delItem(context, delItem) {
        context.commit('delItem', delItem);
        context.dispatch('localStoreCart');
    }
}


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
