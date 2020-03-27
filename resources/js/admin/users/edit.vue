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
        <div class="overline mb-4 red--text">Users</div>
        <div class="headline mb-1">Edit User</div>
        <form method="post">
            <v-row>
                <v-col cols="6" md="6">
                    <v-text-field
                            :counter="40"
                            label="Name"
                            data-vv-name="name"
                            v-model="form.name"
                            required
                    >
                        <template v-slot:prepend>
                            <v-icon :class="{ 'enable' : form.name}">account_box</v-icon>
                        </template>
                    </v-text-field>
                    <span class="red--text" v-if="has_error && errors.name">{{ errors.name.toString() }}</span>
                </v-col>
                <v-col cols="6" md="6">
                    <v-text-field
                            :counter="40"
                            label="Facebook Name"
                            data-vv-name="facebookname"
                            v-model="form.facebookname"
                            required
                    >
                        <template v-slot:prepend>
                            <i class="fa fa-facebook-square fa-2x"
                               v-bind:style="[form.facebookname ? {'color':'blue'}:{'color':'#757575'}]"></i>
                        </template>
                    </v-text-field>
                    <span class="red--text"
                          v-if="has_error && errors.facebookname">{{ errors.facebookname.toString() }}</span>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="6" md="6">
                    <v-menu
                            ref="menu"
                            v-model="menu"
                            :close-on-content-click="true"
                            transition="scale-transition"
                            max-width="290px"
                            min-width="290px"
                    >
                        <template v-slot:activator="{ on }">
                            <v-text-field
                                    label="Birthday"
                                    v-model="form.birthday"
                                    persistent-hint
                                    v-on="on"
                                    readonly
                            >
                                <template v-slot:prepend>
                                    <v-icon :style="[form.birthday ? {'color':'blue'}:{'color':'#757575'}]">event
                                    </v-icon>
                                </template>
                            </v-text-field>
                        </template>
                        <v-date-picker
                                v-model="form.birthday"
                                :landscape="picker.landscape"
                                :reactive="picker.reactive"
                                :full-width="picker.fullWidth"
                                :show-current="picker.showCurrent"
                                :type="picker.month ? 'month' : 'date'"
                                :multiple="picker.multiple"
                                :readonly="picker.readonly"
                                :disabled="picker.disabled"
                        ></v-date-picker>
                    </v-menu>
                    <span class="red--text" v-if="has_error && errors.birthday">{{ errors.birthday.toString() }}</span>
                </v-col>
                <v-col cols="6" md="6">
                    <v-text-field
                            v-model="form.email"
                            :rules="emailRules"
                            label="E-mail"
                            required
                    >
                        <template v-slot:prepend>
                            <v-icon v-bind:style="[form.email ? {'color':'#eded3d'}:{'color':'#757575'}]">email</v-icon>
                        </template>
                    </v-text-field>
                    <span class="red--text" v-if="has_error && errors.email">{{ errors.email.toString() }}</span>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="6" md="6">
                    <v-file-input
                            v-model="form.img"
                            :rules="rules"
                            ref="file"
                            name="img"
                            accept="image/png, image/jpeg, image/bmp"
                            placeholder="User Image"
                            prepend-icon="mdi-camera"
                            label="Picture"
                            @change="onFileChange"
                    >
                    </v-file-input>
                </v-col>
                <v-col cols="6" md="6">
                    <v-avatar size="100">
                        <v-img v-if="url" :src="url" contain></v-img>
                    </v-avatar>
                    <v-icon v-if="url" @click="url=null, form.img =null, newimg=false">cancel</v-icon>

                </v-col>
            </v-row>
            <v-row>
                <v-col cols="6" md="6">
                    <v-text-field
                            v-model="form.location"
                            label="Location"
                    >
                        <template v-slot:prepend>
                            <i class="fa fa-map-marker fa-2x"
                               :style="[form.location ? {'color':'red'}:{'color':'#757575'}]"
                            ></i>
                        </template>
                    </v-text-field>
                    <span class="red--text" v-if="has_error && errors.location">{{ errors.location.toString() }}</span>
                </v-col>
                <v-col cols="6" md="6">
                    <v-text-field
                            :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                            v-model="form.password"
                            :type="show ? 'text' : 'password'"
                            name="input-10-2"
                            label="Password"
                            hint="At least 8 characters"
                            value="wqfasds"
                            class="input-group--focused"
                            @click:append="show = !show"
                    >
                        <!--                        <template v-slot:prepend>-->
                        <!--                            <i class="fa fa-lock fa-2x"></i>-->
                        <!--                        </template>-->
                    </v-text-field>
                    <span class="red--text" v-if="has_error && errors.password">{{ errors.password.toString() }}</span>
                </v-col>
            </v-row>
            <v-row>
                <v-col class="d-flex" cols="12" sm="6">
                    <v-select
                            :items="items"
                            v-model="form.gender"
                            label="Gender"
                            dense
                            outlined
                    >
                        <template v-slot:prepend>
                            <v-icon :style="[form.gender == 'Male' ? {'color':'blue'}:{'color':'pink'}]">
                                supervised_user_circle
                            </v-icon>
                        </template>
                        <template v-slot:selection="data">
                            <v-icon
                                    small
                                    class="mr-2"
                            >
                                {{data.item.icon}}
                            </v-icon>
                            {{data.item.text}}
                        </template>
                        <template slot="item" slot-scope="data">
                            <v-icon
                                    small
                                    class="mr-2"
                            >
                                {{data.item.icon}}
                            </v-icon>
                            {{data.item.text}}
                        </template>
                    </v-select>
                    <span class="red--text" v-if="has_error && errors.gender">{{ errors.gender.toString() }}</span>
                </v-col>
                <v-col class="d-flex" cols="12" sm="6">
                    <v-select
                            :items="status"
                            v-model="form.enable"
                            label="Status"
                            dense
                            outlined
                    >
                        <template v-slot:prepend>
                            <v-icon v-if="form.enable == 1" class="enable">toggle_on</v-icon>
                            <v-icon v-else class="disable">toggle_off</v-icon>
                        </template>

                        <template v-slot:selection="data">
                            <v-icon
                                    small
                                    class="mr-2"
                            >
                                {{data.item.icon}}
                            </v-icon>
                            {{data.item.text}}
                        </template>
                        <template slot="item" slot-scope="data">
                            <v-icon
                                    small
                                    class="mr-2"
                            >
                                {{data.item.icon}}
                            </v-icon>
                            {{data.item.text}}
                        </template>
                    </v-select>
                    <span class="red--text" v-if="has_error && errors.enabled">{{ errors.enabled.toString() }}</span>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="6" md="6">
                    <v-text-field
                            v-model="form.twitter"
                            label="Twitter"
                    >
                        <template v-slot:prepend>
                            <i class="fa fa-twitter-square fa-2x"
                               :style="[form.twitter ? {'color':'blue'}:{'color':'#757575'}]"></i>
                        </template>
                    </v-text-field>
                    <span class="red--text" v-if="has_error && errors.twitter">{{ errors.twitter.toString() }}</span>
                </v-col>
                <v-col cols="6" md="6">
                    <v-text-field
                            v-model="form.linkedin"
                            label="Linkedin"
                    >
                        <template v-slot:prepend>
                            <i class="fa fa-linkedin-square fa-2x"
                               :style="[form.linkedin ? {'color':'blue'}:{'color':'#757575'}]"></i>
                        </template>
                    </v-text-field>
                    <span class="red--text" v-if="has_error && errors.linkedin">{{ errors.linkedin.toString() }}</span>
                </v-col>
            </v-row>

            <v-row>
                <v-col cols="12" md="12">
                    <label>Description</label>
                    <ckeditor :editor="editor" v-model="form.desc" :config="editorConfig"></ckeditor>
                    <span class="red--text"
                          v-if="has_error && errors.desc">{{ errors.desc.toString() }}</span>
                </v-col>
            </v-row>
            <router-link :to="{ name: 'users'}">
                <v-btn class="mr-4" color="normal">Back</v-btn>
            </router-link>
            <v-btn color="primary" @click="store">Save</v-btn>
        </form>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        data() {
            return {
                search: '',
                has_error: false,
                errors: [],
                menu: false,
                show: false,
                url: null,
                newimg: true,
                message: '',
                success: false,
                items: [{text: 'Male', icon: 'mdi-face'}, {text: 'Female', icon: 'mdi-face-woman'}],
                rules: [
                    value => !value || value.size < 2000000 || 'Image size should be less than 2 MB!',
                ],
                status: [{text: 'Enable', icon: 'mdi-nature', value: 1}, {
                    text: 'Disable',
                    icon: 'mdi-cancel',
                    value: 0
                }],
                form: {
                    fb_id: '',
                    ads_admin: '',
                    name: '',
                    facebookname: '',
                    gender: '',
                    desc: '',
                    enable: '',
                    birthday: '',
                    password: '',
                    location: '',
                    email: '',
                    twitter: '',
                    linkedin: '',
                    img: null,

                },
                picker: {
                    date: new Date().toISOString().substr(0, 10),
                    landscape: false,
                    reactive: false,
                    fullWidth: false,
                    showCurrent: false,
                    month: false,
                    multiple: false,
                    readonly: false,
                    disabled: false,
                },
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    placeholder: 'Type Description here...',
                    language: 'ar',
                    toolbar: ['bold', 'italic']

                },
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                ],
            }
        },
        methods: {
            getuser() {
                let id = this.$route.params.id;
                this.axios.get('/users/show/' + id).then((response) => {
                    this.success = true;
                    this.has_error = false;
                    this.message = response.data.message;
                    this.form.fb_id = response.data.data.user.fb_id;
                    this.form.ads_admin = response.data.data.user.ads_admin;
                    this.form.name = response.data.data.user.name;
                    this.form.facebookname = response.data.data.user.facebookname;
                    this.form.gender = response.data.data.user.gender;
                    this.form.desc = response.data.data.user.desc;
                    this.form.enable = response.data.data.user.enabled;
                    this.form.birthday = response.data.data.user.birthday ? new Date(response.data.data.user.birthday).toISOString().substr(0, 10) : '';
                    this.form.location = response.data.data.user.location;
                    this.form.email = response.data.data.user.email;
                    this.form.twitter = response.data.data.user.twitter;
                    this.form.linkedin = response.data.data.user.linkedin;
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
                formData.append('name', this.form.name);
                formData.append('facebookname', this.form.facebookname);
                formData.append('desc', this.form.desc);
                formData.append('enabled', this.form.enable);
                formData.append('password', this.form.password);
                formData.append('gender', this.form.gender);
                formData.append('birthday', this.form.birthday);
                formData.append('location', this.form.location);
                formData.append('email', this.form.email);
                formData.append('img', this.form.img);
                formData.append('newimg', this.newimg);
                formData.append('twitter', this.form.twitter);
                formData.append('linkedin', this.form.linkedin);
                this.axios.post('/users/update/' + id, formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                    }
                ).then((response) => {
                    console.log(response);
                    this.success = true;
                    this.message = response.data.message;
                    this.$router.push({name: 'users', params: {'message': this.message}});
                }).catch((err) => {
                    this.has_error = true;
                    this.success = false;
                    this.message = err.message;
                    this.errors = err.response.data.data.errors;
                });
            },
            onFileChange() {
                if (this.form.img) {
                    this.url = URL.createObjectURL(this.form.img);
                    this.newimg=true;
                }
            },
        },
        created() {
            this.getuser();

        },
        mounted() {
            setTimeout(function () {
                $('#spinner').fadeOut('slow')
            }, 2000)
        }
    }
</script>
<style scoped>
    .fa {
        color: #757575;
    }

    .enable {
        color: green !important;
    }

    .disable {
        color: red !important;
    }
</style>