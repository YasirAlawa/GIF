<template>
    <div>
        <app-home-header></app-home-header>
        <div id="content" class="control-panel">
            <v-row>
                <v-col cols="12" >
                    <v-card class="pa-1" style="box-shadow: none;">
                        <v-row>
                            <v-col cols="3" class="offset-md-1 user_profile">
                                <v-card>
                                    <v-card-title class="card_title">
                                        {{user.name}}
                                    </v-card-title>
                                    <v-card-text style="text-align: center;">
                                        <v-avatar style="height: 125px;
                                            min-width: 100px;
                                            width: 125px;
                                            margin-top: -65px;
                                            box-shadow: 0px 5px 10px -3px;" >
                                            <v-img v-if="user.img" :src="'/image/'+user.img" contain
                                                   style="border: solid 3px #fff;"></v-img>
                                            <v-img v-else src="/image/home/prof.png" contain
                                                   style="border: solid 3px #fff;"></v-img>
                                        </v-avatar>
                                        <p v-html="user.desc" class="mt-4 mb-4 pa-1 text-center"
                                           style="direction:rtl"></p>
                                        <v-row>
                                            <v-col cols="4">
                                                <h5>{{category_count}}</h5>
                                                <small>قسم</small>
                                            </v-col>
                                            <v-col cols="4">
                                                <h5>{{user.views}}</h5>
                                                <small>مشاهدة</small>
                                            </v-col>
                                            <v-col cols="4">
                                                <h5>{{articles.length}}</h5>
                                                <small>عمل</small>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-card>
                            </v-col>

                            <v-col cols="8 " class="works">
                                <h2>الأعمال</h2>
                                <v-card style="direction: rtl">
                                    <v-expansion-panels focusable class="collapse_design">
                                        <v-expansion-panel
                                                v-for="(label,i) in labels"
                                                :key="i" >
                                            <v-expansion-panel-header>{{label.label}}</v-expansion-panel-header>
                                            <v-expansion-panel-content class="pannel__content">
                                                <div class="label_content pa-3 mt-1 mb-1"
                                                        v-for="(article,i) in articles"
                                                        :key="i"
                                                        v-if="article.article && article.label == label.label"
                                                        @click="$router.push('/article/'+article.article.id)">
                                                    {{article.article.title}}
                                                        <span class="v-icon notranslate mdi mdi-link theme--light link_icon"></span>
                                                </div>
                                            </v-expansion-panel-content>
                                        </v-expansion-panel>
                                    </v-expansion-panels>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
        </div>
        <app-footer></app-footer>
    </div>
</template>

<script>
    import Header from './header.vue';
    import Footer from './footer.vue';
    import HomeHeader from './Homeheader.vue';

    export default {
        components: {
            appHeader: Header,
            appFooter: Footer,
            appHomeHeader: HomeHeader,
        },
        data() {
            return {
                has_error: false,
                success: true,
                message: '',
                errors: [],
                user: '',
                category_count: '',
                articles: [],
                labels: [],
            }
        },
        methods: {
            getUser() {
                let id = this.$route.params.id;
                // let formData = new FormData();
                // formData.append('offset', this.offset);
                // console.log(this.offset);
                // this.show = false;
                this.axios.get('/user/profile/' + id,
                ).then((response) => {
                    // console.log(response.data.data.user);
                    // console.log(response.data.data.article[1].article.title);
                    // console.log(response.data.data.article);
                    // console.log(response.data.data.category_count);
                    // console.log(response.data.data.labels);
                    this.articles = response.data.data.article;
                    this.user = response.data.data.user;
                    this.category_count = response.data.data.category_count;
                    this.labels = response.data.data.labels;
                    this.message = response.data.data.message;
                }).catch((err) => {
                    this.has_error = true;
                    console.log(err);
                    this.success = false;
                    this.message = err.message;
                });
            }
        },
        created() {
            this.getUser();
        }
    }
</script>
<style scoped>
    .v-expansion-panel-content.pannel__content > * {
        padding: 0;
    }
    .works{
        padding: 15px 30px;
    }
    .works h2{
        text-align: right;
        padding: 15px 30px;
        background-color: rgb(52, 99, 122);
        border-radius: 45px;
        margin-bottom: 15px;
        color: #fff;
        background-image: url(/image/home/header_call_bg.png);
    }
    .user_profile .theme--light.v-card{
        border-radius: 15px;
    }
    .v-expansion-panel-header >>> .v-expansion-panel-header__icon {
        margin-right: auto !important;
        margin-left: -14px !important;
    }

    .card_title {
        justify-content: center;
        min-height: 130px;
        background-color: rgba(0, 0, 0, 0.8) !important;
        color: #fff;
        font-weight: bold;
        text-transform:uppercase;
        letter-spacing: 2px;
        align-items: baseline;
    }


    .label_content{
        padding: 12px!important;
        padding-right: 10px !important;
        width: calc(100% + 48px);
        margin-right: -24px;
        border: solid 1px #ddd;
        border-radius: 40px;
    }
    .label_content:hover {
        background-color: rgba(35, 81, 103, 0.14);
        color: #444;
        cursor: pointer;
        -webkit-transition: all linear 0.2s;
        transition: all linear 0.2s;
        /* border-left: solid 3px #34637a; */
        /*border-right: solid 3px #34637a;*/
    }
    .label_content .v-icon {
        float: left;
        transform: rotate(140deg);
        background: #34637a82;
        padding: 8px;
        font-size: 20px;
        border-radius: 50%;
        color: #fff;
        margin-top: -6px;
        position: absolute;
        left: 10px;
    }
    .works .v-card.v-sheet.theme--light{
        direction: rtl;
        background-color: transparent;
        box-shadow: none;
        border: none;
    }
    .collapse_design{
        margin: 5px 0;
    }
    .collapse_design.theme--light.v-expansion-panels .v-expansion-panel {
        background-color: transparent;
        color: rgba(0,0,0,.87);
        box-shadow: none;
        border: none;
        margin-bottom: 10px !important;
    }
    .works .theme--light.v-expansion-panels .v-expansion-panel:not(:first-child):after{
        display: none;
    }
    .works .v-expansion-panel-header{
        font-size: 18px;
        padding: 15px 30px;
        min-height: 0;
        font-weight: bold;
        border: solid 1px #ddd;
        border-radius: 30px !important;
    }
    .v-expansion-panel-header:before{
        background-color: rgba(35, 81, 103, 1);
    }
    .works .v-expansion-panel:before{
        box-shadow: none !important;
    }
    .works .pannel__content{
        /*border: solid 1px #ddd;*/
    }
    .label_content:hover > a {
        text-decoration: none;
        color: #fff;
    }

    .label_content > a {
        text-decoration: none;
        color: black;
    }

    #content {
        margin-top: 125px;
    }

    .user_profile .card_title {
        background-image: url(/image/home/header_call_bg.png);
        background-size: auto;
        background-position: bottom left;
        background-repeat: repeat-y;
    }

    @media (max-width: 768px) {
        .user_profile{
            width: 100%;
            flex: 100%;
            max-width: 100%;
        }
        .works{
            width: 100%;
            flex: 100%;
            max-width: 100%;
        }
    }
</style>
