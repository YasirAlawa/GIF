<template>
    <div>
        <v-alert type="success" light v-if="this.$route.params.message">
            {{this.$route.params.message}}
        </v-alert>
        <div v-if="has_error && !success">
            <v-alert type="error" dense>
                        {{message}}
            </v-alert>
        </div>
        <div v-else-if="!has_error && success">
            <v-alert type="success" dense>
                <ul>
                    {{message}}
                </ul>
            </v-alert>
        </div>
        <v-card>
            <sr-bread-crumbs  :breadcrumbs="breadcrumbs"></sr-bread-crumbs>
            <v-card-title>
                History
               
                <v-spacer></v-spacer>
           
            </v-card-title>
            <v-data-table item-key="id" class="elevation-1"
                          :headers="headers"
                          :items="items"
                     
            >
                
            </v-data-table>
        </v-card>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                breadcrumbs: [
                    {
                        text: 'Home',
                        disabled: false,
                        to: '/Admin',
                    },
                   

                ],
         
                success: false,
                has_error: false,
                message: '',
                items:[],
               

                headers: [
                   
                    {
                        text: 'Date',
                        align: 'left',
                     
                        value: 'date',
                    },
                    {text: 'Key Words', value: 'key_words'},
               
                ],
            }
        },
        methods: {
            loadItems() {
                this.axios.get('users/history').then((res) => {
                    
                    if (res.data.status == 'error') {
                        this.has_error = true;
                        this.message = res.data.message;
                    } else {
                        this.items = res.data.data.history;
                     
                    }
                })
            },
            
        },
        mounted() {
            setTimeout(function () {
                $('#spinner').fadeOut('slow')
            }, 3000)
        },
        created() {
            this.loadItems();
            $('#spinner').fadeIn(100)
        }
    }
</script>