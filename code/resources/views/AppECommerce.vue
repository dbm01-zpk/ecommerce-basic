<template>
    <v-app>

        <NavBar></NavBar>

        <v-main>
            <router-view></router-view>
        </v-main>

    </v-app>
</template>

<script>

import NavBar from './layout/NavBar.vue';

export default {
    components: {
        NavBar
    }
}

</script>
