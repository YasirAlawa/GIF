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
        <div class="overline mb-4 red--text">Permissions</div>
        <div class="headline mb-1">Edit Permissions</div>
        <form method="post">
            <v-row>
                <v-col cols="12" md="6">
                    <v-text-field
                            :counter="20"
                            label="Permission Name"
                            data-vv-name="name"
                            v-model="form.name"
                            required
                    ></v-text-field>
                    <span class="red--text" v-if="has_error && errors.name">{{ errors.name.toString() }}</span>
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
                success: false,
                category: '',
                form: {
                    name: '',
                },
            }
        },
        methods: {
            getpermission() {
                let id = this.$route.params.id;
                this.axios.get('/users/permission/show/' + id).then((response) => {
                    console.log(response);
                    this.success = true;
                    this.message = response.data.message;
                    this.form.name = response.data.data.permission.name;
                })
                    .catch((err) => {
                        this.has_error = true;
                        this.message = err.message;
                        this.errors = err.response.data.errors;
                    });
            },
            store() {
                let id = this.$route.params.id;
                let formData = new FormData();
                this.success = false;
                formData.append('name', this.form.name);
                this.axios.post('/users/permission/update/' + id, formData
                ).then((response) => {
                    console.log(response);
                    this.success = true;
                    this.message = response.data.message;
                    this.$router.push({name: 'permissions', params: {'message': this.message}});
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
            this.getpermission();
        }
    }
</script>