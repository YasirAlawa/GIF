<template>
    
    <v-app>
            <vue-headful title="Title from vue-headful"/>
            <div>
                <router-view></router-view>
            </div>
    </v-app>
</template>

<script>
    

    export default {
        components: {
            
        },
        mounted() {
            setTimeout(function () {
                $('#spinner').fadeOut('slow')
            }, 3000)
        },
    }
</script>
