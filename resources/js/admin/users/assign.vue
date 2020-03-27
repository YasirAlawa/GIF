<template>
    <div class="ma-10">
        <div v-if="has_error && !success">
            <v-alert type="error" dense>
                <ul>
                    <li v-for="error in errors ">
                        {{error}}
                    </li>
                </ul>
            </v-alert>
        </div>
        <div class="overline mb-4 red--text">Users Groups</div>
        <div class="headline mb-1">Edit User Groups</div>
        <form method="post">
            <v-row>
                <v-col cols="12" md="6">
                    <v-avatar v-if="url" size="100">
                        <v-img :src="url" contain></v-img>
                    </v-avatar>
                    <p><b>User:</b> {{name}}</p>
                    <p><b>Facebook Name:</b> {{facebookname}}</p>
                </v-col>
                <v-col cols="12" md="12">
                    <v-autocomplete
                            v-model="form.roles"
                            :items="roles"
                            label="Groups"
                            item-text="name"
                            item-value="name"
                            multiple
                            chips
                    ></v-autocomplete>
                    <span class="red--text" v-if="has_error && errors.permissions">{{ errors.permissions.toString() }}</span>
                </v-col>
            </v-row>
            <router-link to="show">
                <v-btn class="mr-4" color="normal">Back</v-btn>
            </router-link>
            <v-btn color="primary" @click="store">Save</v-btn>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                search: '',
                has_error: false,
                errors: [],
                message: '',
                url:'',
                name:'',
                facebookname:'',
                success: false,
                category: '',
                roles:[],
                form: {
                    roles: [],
                },
            }
        },
        methods: {
            getrole() {
                this.axios.get('/users/role/index').then((response) => {
                    console.log(response);
                        this.roles = response.data.data.roles;
                        console.log(this.roles);
                })
                    .catch((err) => {
                        this.has_error = true;
                        this.message = err.message;
                        this.errors = err.response.data.errors;
                    });
            },
            getuserrole() {
                let id = this.$route.params.id;
                this.axios.get('/users/user_role/' + id).then((response) => {
                    console.log(response);
                    this.form.roles = response.data.data.role;
                })
                    .catch((err) => {
                        this.has_error = true;
                        this.message = err.message;
                        this.errors = err.response.data.errors;
                    });
            },
            getuser() {
                let id = this.$route.params.id;
                this.axios.get('/users/show/' + id).then((response) => {
                    this.success = true;
                    this.has_error = false;
                    this.message = response.data.message;
                    this.name = response.data.data.user.name;
                    this.facebookname = response.data.data.user.facebookname;
                    if(response.data.data.user.img)
                        this.url = '/image/'+ response.data.data.user.img;
                })
                    .catch((err) => {
                        this.has_error = true;
                        this.success = false;
                        this.message = err.message;
                        this.errors = err.response.data.errors;
                    });
            },
            store() {
                let id = this.$route.params.id;
                let formData = new FormData();
                this.success = false;
                formData.append('roles', this.form.roles);
                this.axios.post('/users/add_user_role/' + id, formData
                ).then((response) => {
                    console.log(response);
                    this.success = true;
                    this.message = response.data.message;
                    this.$router.push({name: 'users', params: {'message': this.message}});
                }).catch((err) => {
                    console.log(err.response.data);
                    this.has_error = true;
                    this.message = err.response.data.data.message;
                    this.errors = err.response.data.data.errors;
                    console.log(this.errors);

                });
            },
        },
        created() {
            this.getrole();
            this.getuser();
            this.getuserrole();
            // this.getpermissions();
        }
    }
</script>