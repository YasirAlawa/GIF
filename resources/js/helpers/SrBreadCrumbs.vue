<template>

    <v-breadcrumbs  :items="breadcrumbs">
        <v-breadcrumbs-item
                slot="item"
                slot-scope="{ item }"
                exact
                :to="item.to">
            {{ item.text }}
        </v-breadcrumbs-item>
    </v-breadcrumbs>
</template>

<script>
    export default {
        props: {
            breadcrumbs: {
                type: Array,
                required: true
            },
        },
        data() {
            return {};
        },
        methods:{
            goTo (payload) {
                this.$router.push(payload)
            },
        },
        created() {
        }
    }

</script>
