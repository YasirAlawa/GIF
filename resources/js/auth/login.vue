<template>
    <div>
        <div class="admin_background">
        </div>
        <v-content style="margin-top: 5%">
            <v-container class="container">
                <div class="login_form pa-10 shadow">
                   
                    <div v-if="has_error && !success">
                        <v-alert type="error" dense>
                            {{errors}}
                        </v-alert>
                    </div>
                    <form v-on:submit.prevent="login">
                        <v-container fluid
                        >
                            <div class="text-center">
                                <v-row
                                        justify="center"
                                >
                                    <v-col cols="12" md="12">
                                        <v-text-field
                                                solo
                                                prepend-inner-icon="email"
                                                label="Email"
                                                name="login"
                                                type="text"
                                                v-model="form.email"
                                        />
                                    </v-col>
                                </v-row>
                                <v-row
                                        justify="center"
                                >
                                    <v-col cols="12" md="12">

                                        <v-text-field
                                                solo
                                                prepend-inner-icon="lock"
                                                id="password"
                                                label="Password"
                                                name="password"
                                                type="password"
                                                v-model="form.password"
                                        />
                                    </v-col>
                                </v-row>
                                <v-btn class="ma-auto"
                                       large
                                       :loading="loading"
                                       :disabled="loading"
                                       fab
                                       type="submit"
                                       >
                                    <v-icon color="success">mdi-lock-open</v-icon>
                                </v-btn>
                            </div>
                        </v-container>

                    </form>
                </div>
            </v-container>
        </v-content>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                },
                has_error: false,
                loading: false,
                errors: '',
                message: '',
                success: false,
            }
        },
        components: {
            //     appHeader: Header,
            //appMenu: Menu,
        },
        methods: {
            login() {
                this.loading=true;
                this.$auth.login({
                    data: {
                        email: this.form.email,
                        password: this.form.password,
                    },
                    success: function (response) {
                        console.log(response);
                        this.message = response.data.message;
                        this.$router.push({name: 'Admin'})
                    },
                    error: function (res) {
                        this.loading=false;
                        this.has_error = true;
                        console.log(res.response.data);
                        this.errors = res.response.data.error;
                        this.message = res.response.data.msg;
                    },
                    rememberMe: true,
                    fetchUser: true
                });
            }
        },
        mounted() {
            setTimeout(function () {
                $('#spinner').fadeOut('slow')
            }, 2000)
        },
    }
</script>
<style scoped>
    .admin_background::after {
        content: "";
        background: url("/image/admin/background_login2.jpg") center no-repeat !important;
        background-size: cover !important;
        opacity: 0.5;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
    }
    .login_form{
        border-radius: 20px;
        position: relative;
        z-index: 3;
    }
    .login_form::after{
        content: "";
        /*background: url("/image/home/logo_hd.png") center no-repeat !important;*/
        /*background-size: cover !important;*/
        background-color: black;
        border-radius: 20px;
        opacity: 0.6;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        z-index: -1;
    }

    .container {
        display: flex;
        justify-content: center;
    }
    .shadow{
        -webkit-box-shadow: 0px -3px 33px 1px rgba(0,0,0,0.64);
        -moz-box-shadow: 0px -3px 33px 1px rgba(0,0,0,0.64);
        box-shadow: 0px -3px 33px 1px rgba(0,0,0,0.64);
    }

    .under_bg {
        background-color: rgba(99, 107, 111, 0.24);
    }
</style>