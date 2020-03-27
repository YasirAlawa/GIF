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
                Users
                <router-link to="/Admin/users/add">
                    <v-btn small color="primary" style="margin-left: 20px">
                        Add User
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
                          :items="users"
                          :options.sync="pagination"
                          :server-items-length="total"
                          :loading="loading"
            >
                <template v-slot:item.action="{ item }">
                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <router-link :to="'/Admin/users/edit/'+item.id">

                                <v-icon
                                        v-on="on"
                                        small
                                        class="mr-2"
                                >
                                    edit
                                </v-icon>
                            </router-link>
                        </template>
                        <span>Edit</span>
                    </v-tooltip>


                    <v-tooltip top>
                        <template v-slot:activator="{ on }">
                            <router-link :to="'/Admin/users/assign/'+item.id">
                            <v-icon
                                    v-on="on"
                                    small
                                    class="mr-2"
                            >
                                assignment_turned_in
                            </v-icon>
                            </router-link>
                        </template>
                        <span>Assign to Group</span>
                    </v-tooltip>
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
                users: [],
                sub: '',
                loading:false,
                total:0,
                pagination:{},
                headers: [
                    {text: 'ID', value: 'id'},
                    {
                        text: 'Name',
                        align: 'left',
                        sortable: true,
                        value: 'name',
                    },
                    {text: 'Email', value: 'email'},
                    // {text: 'Status', value: 'ord'},
                    {text: 'Action', sortable: false, value: 'action'},
                ],
            }
        },
        watch: {
            pagination() {
                this.getItems();
            },
            search() {
                this.getItems();
            }
        },
        methods: {
            getUrl()
            {
                var page = this.pagination.page;
                var itemsPerPage = this.pagination.itemsPerPage;
                var sortBy = this.pagination.sortBy;
                var sortDesc = this.pagination.sortDesc;
                var url = 'users/index/'+(page?page:1);
                url +='/'+(itemsPerPage?itemsPerPage:20);
                url +='/'+( sortBy && sortBy[0] ? sortBy[0]:'null' );
                url +='/'+( sortDesc && sortDesc[0] ?  (sortDesc[0]?1:0) :'null' );
                url +='/'+( this.search ?  this.search :'null' );
                return url;
            },
            getItems() {
                this.loading = true;
                this.axios.get(this.getUrl()).then((res) => {
                    this.loading = false;

                    if (res.data.status == 'error') {
                        this.has_error = true;
                        this.message = res.data.message;
                    } else {
                        this.users = res.data.data.users;
                        this.total = res.data.data.count;
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
                            this.axios.post('category/delete-category/' + id).then((res) => {
                                    this.success=true;
                                    console.log(res.data);
                                    this.message = res.data.message;
                                    swal("Poof! Your imaginary file has been deleted!", {
                                        icon: "success",
                                    });
                                this.getItems();
                                }).catch(error => {
                                            this.has_error = true;
                                            this.message = error.response.data.message;
                                            swal("Error Operation", {
                                                icon: "error",
                                            });
                                    });
                            // })
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    }
                );
            }
        },

    }
</script>