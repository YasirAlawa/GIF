<template>
    <v-app>
        <div>
            <app-header></app-header>
            <app-dashboard v-if="this.$route.name === 'Admin'"></app-dashboard>
            <div v-else id="content" class="control-panel grid-table">
                <router-view ></router-view>

            </div>
        </div>
    </v-app>

</template>

<script>
    import Header from './header.vue';
    import DashBoard from './dashboard.vue';

    export default {
        components: {
            appHeader: Header,
            appDashboard: DashBoard,
        },
       
    }
</script>
<style scoped>
   
</style>
