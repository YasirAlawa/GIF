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
        <div class="overline mb-4 red--text">Groups</div>
        <div class="headline mb-1">Add User's Group</div>
        <form method="post">
            <v-row>
                <v-col cols="12" md="6">
                    <v-text-field
                            :counter="20"
                            label="Group Name"
                            data-vv-name="name"
                            v-model="form.name"
                            required
                    ></v-text-field>
                    <span class="red--text" v-if="has_error && errors.name">{{ errors.name.toString() }}</span>
                </v-col>
                <v-col cols="12" md="12">
                <v-autocomplete
                            v-model="form.permissions"
                            :items="permissions"
                            label="Permissions"
                            item-text="name"
                            item-value="name"
                            multiple
                            chips
                    ></v-autocomplete>
                    <router-link to="index">
                        <v-btn class="mr-4" color="normal">Back</v-btn>
                    </router-link>
                    <v-btn color="primary" @click="store">Save</v-btn>
                </v-col>
            </v-row>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                search: '',
                permissions:[],
                has_error: false,
                success:false,
                errors: [],
                message: '',
                form: {
                    name: '',
                    permissions: [],
                },
            }
        },
        methods: {
            getpermissions() {
                this.axios.get('users/permission/index').then((res) => {
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
            store() {
                let formData = new FormData();
                formData.append('name', this.form.name);
                formData.append('permissions', this.form.permissions);
                this.axios.post('users/role/add', formData
                ).then((response) => {
                    this.success = true;
                    this.message = response.data.message;
                    this.$router.push({name: 'roles', params: {'message': this.message}});
                }).catch((err) => {
                    this.has_error = true;
                    this.message = err.message;
                    this.errors = err.response.data.data.errors;
                });
            },
        },
        created() {
            this.getpermissions();
        }
    }
</script>