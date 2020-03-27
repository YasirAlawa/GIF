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
            <v-card-title>
                Permissions
                <router-link to="/Admin/users/permission/add">
                    <v-btn small color="primary" style="margin-left: 20px">
                        Add Permission
                    </v-btn>
                </router-link>
                <v-spacer></v-spacer>
                <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table item-key="id" class="elevation-1"
                          :headers="headers"
                          :items="permissions"
                          :search="search"
            >
                <template v-slot:item.action="{ item }">
                    <router-link :to="'/users/permission/edit/'+item.id">

                        <v-icon
                                small
                                class="mr-2"
                        >
                            edit
                        </v-icon>
                    </router-link>

                    <v-icon
                            small
                            @click="onDelete(item.id)"
                    >
                        delete
                    </v-icon>
                </template>
            </v-data-table>
        </v-card>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                search: '',
                success: false,
                has_error: false,
                message: '',
                permissions:[],
                headers: [
                    {text: 'ID', value: 'id'},
                    {
                        text: 'Name',
                        align: 'left',
                        sortable: true,
                        value: 'name',
                    },
                    {text: 'Action', sortable: false, value: 'action'},
                ],
            }
        },
        methods: {
            getpermissions() {
                this.axios.get('/users/permission/index').then((res) => {
                    console.log(res);
                    if (res.data.status == 'error') {
                        this.has_error = true;
                        this.message = res.data.message;
                    } else {
                        this.permissions = res.data.data.permissions;
                        console.log(this.permissions);
                    }
                })
            },
            onDelete(id) {
                swal({
                    title: "Are you sure?",
                    text: "You won't be able to revert this action!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete it!',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                        if (willDelete) {
                            this.axios.post('/users/permission/delete/' + id).then((res) => {
                                    this.success=true;
                                    this.has_error=false;
                                    console.log(res.data);
                                    this.message = res.data.message;
                                    swal("Permission has been deleted!", {
                                        icon: "success",
                                    });
                                    this.getpermissions();
                                }).catch(error => {
                                            this.has_error = true;
                                            this.success = false;
                                            this.message = error.response.data.message;
                                            swal("Error Operation", {
                                                icon: "error",
                                            });
                                    });
                        } else {
                            swal("Permission is safe!");
                        }
                    }
                );
            }
        },
        mounted() {
            setTimeout(function () {
                $('#spinner').fadeOut('slow')
            }, 3000)
        },
        created() {
            this.getpermissions();
            $('#spinner').fadeIn(100)
        }
    }
</script>