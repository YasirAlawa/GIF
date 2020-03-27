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
        <div class="headline mb-1">Add Permission</div>
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
                success: false,
                has_error: false,
                errors: [],
                message: '',
                form: {
                    name: '',
                },
            }
        },
        methods: {
            store() {
                let formData = new FormData();
                formData.append('name', this.form.name);
                this.axios.post('users/permission/add', formData
                ).then((response) => {
                    this.success = true;
                    this.message = response.data.message;
                    this.$router.push({name: 'permissions', params: {'message': this.message}});
                }).catch((err) => {
                    this.has_error = true;
                    this.message = err.message;
                    this.errors = err.response.data.data.errors;
                });
            },
        },
        created() {
        }
    }
</script>