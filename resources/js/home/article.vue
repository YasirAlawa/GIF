<template>
    <div>
        <app-home-header></app-home-header>
        <!--#################### The Article #######################-->
        <div id="theArticle" class=" col-md-12">
            <v-row v-if="theArticle" class="rtl_direction mb-md-5 ">
                <div :class="{'active':!show_articles}"
                     class="text-center col-md-9 back_color cat_sub_header"
                     v-if="selected_cat != null && selected_sub_cat != null" style="display: flex;">


                    <!--                    <div class="__float-left"-->
                    <!--                         style="display: inline-block;"-->
                    <!--                         :elevation="hover ? 12 : 2"-->
                    <!--                         :class="{ 'on-hover': hover }">-->
                    <!--                        <v-img v-if="category.img"-->
                    <!--                               :src="'/image/'+category.img" contain aspect-ratio="1.7"></v-img>-->
                    <!--                        <v-avatar v-else color="#4d888a" size="100" class="avatar_shadow" style="margin-top: 28px;">-->
                    <!--                            <v-img src="/image/home/logo_hd.png" contain></v-img>-->
                    <!--                        </v-avatar>-->
                    <!--                        <div class="mt-5 mb-5">-->
                    <!--                            <a class="pa-3"-->
                    <!--                               v-on:click="back_from_art_to_category">-->
                    <!--                                عودة إلى الصفحة الرئيسية-->
                    <!--                                <v-icon class="animated infinite flash delay-2s">mdi-skip-backward</v-icon>-->
                    <!--                            </a>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <div class="__float-left" style="padding-top: 5%;">-->
                    <!--                        <p>-->
                    <!--                            الفئة:-->
                    <!--                            {{category.name}}-->
                    <!--                        </p>-->
                    <!--                        <p>-->
                    <!--                            عدد الفئات الفرعية:-->
                    <!--                            {{sub_cat_count}}-->
                    <!--                        </p>-->
                    <!--                    </div>-->


                    <div class="main__category">
                        <div class="main__category__container">
                            <div class="category__icon">
                                <v-img class="responsive_link_header" v-if="category.img"
                                       :src="'/image/'+category.img"
                                       aspect-ratio="1.7" contain></v-img>
                                <v-img class="responsive_link_header logo_replaced" v-else src="/image/home/logo_hd.png"
                                       aspect-ratio="1.7"
                                       contain></v-img>
                            </div>
                            <div class="category__details">
                                <p v-if="category">
                                    الفئة:
                                    {{category.name}}
                                </p>
                                <p>
                                    عدد الفئات الفرعية:
                                    {{sub_cat_count}}
                                </p>
                            </div>
                        </div>
                        <div class="mt-5 mb-5" style="clear:both">
                            <a class=" forward-button"
                               v-on:click="back_from_art_to_category">
                                <v-icon class="animated infinite delay-2s">mdi-skip-forward</v-icon>
                                عودة إلى الفئات الرئيسية
                            </a>
                        </div>
                    </div>


                    <!--                    <div class="__float-left">-->
                    <!--                        <v-img v-if="sub_category.img"-->
                    <!--                               :src="'/image/'+sub_category.img" contain aspect-ratio="1.7"></v-img>-->
                    <!--                        <v-avatar v-else color="#4d888a" size="100" class="avatar_shadow" style="margin-top: 28px;">-->
                    <!--                            <v-img src="/image/home/logo_hd.png" contain></v-img>-->
                    <!--                        </v-avatar>-->
                    <!--                        <div class="mt-5 mb-5">-->
                    <!--                            <a class="pa-3"-->
                    <!--                               v-on:click="back_from_art_to_sub">-->
                    <!--                                عودة إلى الفئات الفرعية-->
                    <!--                                <v-icon class="animated infinite flash delay-2s">mdi-skip-backward</v-icon>-->
                    <!--                            </a>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <div class="__float-left" style="padding-top: 5%;">-->
                    <!--                        <p>-->
                    <!--                            الفئة الفرعية:-->
                    <!--                            {{sub_category.name}}-->
                    <!--                        </p>-->
                    <!--                        <p>-->
                    <!--                            عدد المقالات في الفئة:-->
                    <!--                            {{article_count}}-->
                    <!--                        </p>-->
                    <!--                    </div>-->


                    <div id="show_sub_selected" class="main__category">
                        <div class="main__category__container">
                            <div class="category__icon">
                                <v-img class="responsive_link_header"
                                       v-if="sub_category.img"
                                       :src="'/image/'+sub_category.img" aspect-ratio="1.7"
                                       contain></v-img>

                                <v-img v-else class="responsive_link_header logo_replaced" src="/image/home/logo_hd.png"
                                       aspect-ratio="1.7"
                                       contain></v-img>
                            </div>
                            <div class="category__details">
                                <p style="display: block">
                                    الفئة الفرعية:
                                    {{sub_category.name}}
                                </p>
                                <p style="display: block">
                                    عدد المقالات في الفئة:
                                    {{article_count}}
                                </p>
                            </div>
                        </div>
                        <div class="mt-5 mb-5" style="clear:both" v-if="sub_category != null">
                            <a class="forward-button"
                               v-on:click="back_from_art_to_sub">
                                <v-icon class="animated infinite delay-2s">mdi-skip-forward</v-icon>
                                عودة إلى الفئات الفرعية
                            </a>
                        </div>

                    </div>
                    <div style="clear: both;"></div>
                </div>


                <div
                        class="col-md-3 back_color cat_sub_header"
                        v-if="category_admin">
                    <h1 class="mb-5">إدارة القسم</h1>
                    <div v-for="(admin,index) in category_admin" :key="admin.id" class="mb-4 display-flex">
                        <router-link :to="'/user/'+admin.id" class="worker">
                            <h4 class="__float-right mt-4 ml-4 cate_admin_name">{{admin.name}}</h4>
                            <v-avatar color="#4d888a" size="60" class="shadow">
                                <v-img v-if="admin.img" :src="'/image/'+admin.img" contain></v-img>
                                <v-img v-else src="/image/home/prof.png" contain></v-img>
                            </v-avatar>
                        </router-link>
                    </div>
                </div>
            </v-row>
        </div>
        <v-container>

            <v-row v-if="theArticle" class="rtl_direction">
                <div class="header-title col-sm-12 ">
                    <h4 :class="removeSpaces(category.english_name) +'-button'">{{theArticle.title}}</h4>
                    <v-img v-if="category.img" :src="'/image/'+category.img" contain aspect-ratio="1.7"></v-img>
                    <v-img v-else src="/image/home/logo_hd.png" contain aspect-ratio="1.7"></v-img>
                </div>
                <div class="col-sm-12 col-md-9 article_content">
                    <v-card class="card-border">
                        <div style="height: 100%">
                            <v-img :src="'/image/'+theArticle.home_picture.path" contain aspect-ratio="1.5"></v-img>
                        </div>
                        <div class="mt-6 mr-4 pa-3">
                            <p v-html="article_body"></p>
                        </div>
                    </v-card>
                </div>
                <div class="col-md-3 col-sm-6 responsive_members">
                    <v-card class="mb-4 members-card">
                        <v-card-title style="background-color: #EEE;">
                            <p>
                                المقال إعداد:
                            </p>
                            <v-icon>mdi-creation</v-icon>
                        </v-card-title>
                        <div style="height:100%; text-align:center;" class="pa-1">
                            <div v-for="(user,index) in theArticle.signature" :key="index" class="users-div">
                                <router-link :to="'/user/'+user.limited_user.id" class="worker">
                                    <div class="">
                                        <v-avatar size="70">
                                            <v-img v-if="user.limited_user.img"
                                                   :src="'/image/'+user.limited_user.img"></v-img>
                                            <v-img v-else src="/image/home/prof.png"></v-img>
                                        </v-avatar>
                                    </div>
                                    <div class="__float-left ml-3"
                                         style="font-size: 12px;min-width: 50%; text-align:right">
                                        <strong>{{user.label}}</strong>
                                        <p>
                                            {{user.limited_user.name}}
                                        </p>
                                    </div>
                                </router-link>
                                <div style="clear: both"></div>
                            </div>
                        </div>
                    </v-card>
                    <v-card class="card-border">
                        <v-card-title style="background-color: #EEE;">
                            <p>
                                مواضيع مشابهة
                            </p>
                            <v-icon>mdi-animation</v-icon>
                        </v-card-title>
                        <div class="seems-articles">
                            <div v-for="(article,index) in random_articles" :key="index" class="pa-2">
                                <router-link :to="'/article/'+article.id">
                                    <v-img v-if="article.home_picture"
                                           class="border-bottom"
                                           :src="'/image/'+article.home_picture.path"
                                           aspect-ratio="2"></v-img>
                                    <v-avatar v-else size="180" class="shadow">
                                        <v-img src="/image/home/logo_hd.png" contain></v-img>
                                    </v-avatar>
                                    <div class="seem-title">
                                        <span>{{article.title.substring(0,30) + '...'}}</span>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                    </v-card>
                </div>
            </v-row>
            <v-row class="rtl_direction">
                <div class="col-sm-6 col-md-9">

                    <v-card class="sources">
                        <v-card-title style="background-color: #EEE;" class="mb-5">
                            <p>
                                المصادر
                            </p>
                            <v-icon class="sources-icon">mdi-link-variant</v-icon>
                            <v-btn text icon color="blue" :href="article_face_url" target="_blank" class="face_btn">
                                <v-icon x-large>
                                    mdi-facebook-box
                                </v-icon>
                            </v-btn>
                        </v-card-title>
                        <v-card-text v-for="(source,index) in sources" v-bind:key="source.id" class="source_name">
                            <h4 style="display:inline-block">مصدر {{index + 1}}</h4>
                            <a :href="source.url">
                                هنا
                            </a>
                        </v-card-text>
                    </v-card>
                </div>
            </v-row>
        </v-container>
        <app-footer></app-footer>
    </div>
</template>
<script>
    import Header from './header.vue';
    import Footer from './footer.vue';
    import HomeHeader from './Homeheader.vue';

    let ROOT_PATH = Laravel.baseUrl;
    export default {
        components: {
            appHeader: Header,
            appFooter: Footer,
            appHomeHeader: HomeHeader,
        },

        // metaInfo () {
        //     return {
        //         meta: [
        //             {name: 'description', content: this.theArticle ? this.theArticle.title : "Article"},
        //             {property: 'og:description', content: this.theArticle ? this.theArticle.title : "Article"},
        //             {property: 'og:image', content: this.theArticle ? ROOT_PATH+'image/'+this.theArticle.home_picture.path : ROOT_PATH+'image/home/home.jpg'},
        //             {property: 'og:image:url', content: this.theArticle ? ROOT_PATH+'image/'+this.theArticle.home_picture.path : ROOT_PATH+'image/home/home.jpg'},
        //             {property: 'og:image:width', content: '1240'},
        //             {property: 'og:image:height', content: '650'}
        //         ]
        //     }
        // },
        data() {
            return {
                has_error: false,
                success: false,
                errors: [],
                category: '',
                category_admin: [],
                random_articles: [],
                sources: [],
                article_face_url: '',
                sub_category: '',
                article_count: '',
                sub_cat_count: '',

                img: '',
                name: '',
                arabic_description: '',
                english_description: '',
                english_name: '',
                hover: '',
                selected_cat: '',
                selected_sub_cat: '',
                selected_article: '',
                theArticle: null,
                article_body: null,

                offset: 0,
                sub_offset: 0,
                article_offset: 0,

                btn_disabled: false,
                show: true,
                show_cat: true,
                show_sub_cat: false,
                show_articles: false,

                selected_cat_inArray: null,
                selected_sub_cat_inArray: null,
                selected_article_inArray: null,

                content_more: 'category',
            }
        },
        methods: {

            get_category_admin() {
                this.axios.get('category/admin/' + this.theArticle.cat_id).then((res) => {
                    this.category_admin = res.data.data.admin;
                    this.category = res.data.data.category;
                    this.article_count = res.data.data.article_count;
                    this.sub_cat_count = res.data.data.sub_cat_count;
                    this.has_error = false;
                    this.message = res.data.data.message;
                }).catch((err) => {
                    this.has_error = true;
                    this.success = false;
                    this.message = err.message;
                    this.errors = err.response.data.errors;
                });
            },
            get_the_article() {
                this.axios.get('article/theArticle/' + this.$route.params.id).then((res) => {
                    console.log(res.data.data);
                    this.theArticle = res.data.data.articles;
                    this.article_body = res.data.data.article_body;
                    this.selected_cat = res.data.data.articles.cat_id;
                    this.selected_sub_cat = res.data.data.articles.sub_cat_id;
                    this.sub_category = res.data.data.articles.sub_category;
                    this.sources = res.data.data.articles.article_sources;
                    this.article_face_url = res.data.data.article_face_url;
                    this.get_category_admin();
                    this.get_random_articles();
                    console.log(this.theArticle.home_picture.path)

                }).catch((err) => {
                    this.has_error = true;
                    this.success = false;
                    this.message = err.message;
                    this.errors = err.response.data.errors;
                });

            },
            click_suggeste_article(array_index, theArticle_id) {
                this.show_cat = false;
                this.show_sub_cat = false;
                this.show_articles = false;
                this.selected_sub_cat_inArray = array_index;
                this.selected_article = theArticle_id;
                this.content_more = 'article';
                var local = this;
                setTimeout(
                    function () {
                        $('#theArticle').fadeOut(500, function () {
                            local.get_the_article();
                            $('#theArticle').fadeIn(500);
                        });
                    }, 900);
            },
            show_more(e) {
                if (e == 'category') {
                    this.getcategories();
                } else if (e == 'subcategory') {
                    this.get_sub_categories();
                } else {
                    this.get_articles();
                }
            },
            back_from_sub_to_category() {
                this.show_sub_cat = false;
                this.content_more = 'category';
                this.show = true;
                this.btn_disabled = false;
                var local = this;
                setTimeout(function () {
                    $('#sub_cate').slideUp(500, function () {
                        local.show_cat = true;
                        $('#category').slideDown(500);
                    })
                }, 900);
            },
            back_from_art_to_category() {
                this.$router.push({name: 'home'});
            },
            back_from_art_to_sub() {
                this.$router.push({
                    name: 'home', params: {
                        show_articles_prop: 'false',
                        cat_id_prop: this.theArticle.cat_id,
                        sub_cat_id_prop: this.theArticle.sub_cat_id,
                        show_cat_prop: 'false',
                        show_sub_cat_prop: 'true',
                        content_more_prop: 'subcategory',
                        show_prop: 'true',
                        btn_disabled_prop: 'false',
                        msg: 'aaaa'

                    }, props: true
                })
            },
            get_random_articles() {
                // let formData = new FormData();
                // formData.append('id', selected_sub_cat);
                this.axios.get('/article/byCategory/' + this.selected_sub_cat).then((res) => {
                    this.has_error = false;
                    this.random_articles = res.data.data.random_articles;
                    this.message = res.data.data.message;
                    console.log(this.random_articles);
                }).catch((err) => {
                    this.has_error = true;
                    this.success = false;
                    this.message = err.message;
                    this.errors = err.response.data.errors;
                });
            },
            removeSpaces(str = null) {
                if (str != null) {
                    str = str.toLowerCase().trim();
                    str = str.replace(/\s/g, '');
                    return str;
                }
            },
            // add_meta() {
            //     var html = '<meta property="og:image" content="/image/' + this.theArticle.home_picture.path + '"/>' +
            //         '<meta property="og:image:url" content="/image/' + this.theArticle.home_picture.path + '"/>' +
            //         '<meta property="og:image:width"  content="1240"/>' +
            //         '<meta property="og:image:height" content="650"/>';
            // }
        },
        created() {
            this.get_the_article();
            // document.title = 'New Title';
            // document.head.querySelector('meta[name=description]').content = 'New Description';
        }
    }
</script>


<style>
    @import "../../sass/animate.css";

    .rtl_direction {
        direction: rtl;
    }

    .source_name {
        font-size: 18px;
    }

    #theArticle {
        margin-top: 125px;
    }

    .display-flex {
        display: flex;
    }

    .worker {
        color: #555;
    }

    .worker:hover {
        color: black;
    }

    .show_more {
        letter-spacing: normal !important;
    }

    .back_color {
        background-color: #eee;
    }

    .cate_admin_name {
        min-width: 45%;
    }

    .face_btn {
        position: absolute;
        left: 10px;
    }

    .slide-enter-active {
        -moz-transition-duration: 0.3s;
        -webkit-transition-duration: 0.3s;
        -o-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -moz-transition-timing-function: ease-in;
        -webkit-transition-timing-function: ease-in;
        -o-transition-timing-function: ease-in;
        transition-timing-function: ease-in;
    }

    .slide-leave-active {
        -moz-transition-duration: 0.3s;
        -webkit-transition-duration: 0.3s;
        -o-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -moz-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
        -webkit-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
        -o-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
        transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
    }

    .slide-enter-to, .slide-leave {
        max-height: 100px;
        overflow: hidden;
    }

    .slide-enter, .slide-leave-to {
        overflow: hidden;
        max-height: 0;
    }

    .shadow:hover {
        -webkit-box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
        box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
    }

    .shadow {
        transition: all linear .5s;
    }

    .avatar_shadow {
        -webkit-box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
        box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
    }

    .jumbe_hover:hover {
        -webkit-animation-name: bounce;
        animation-name: bounce;
        -webkit-transform-origin: center bottom;
        transform-origin: center bottom;
    }

    .show-btns {
        color: rgba(255, 255, 255, 1) !important;
    }

    .cat_name {
        border-radius: 4px;
        padding: 16px;
        /*transition: box-shadow .28s cubic-bezier(.4, 0, .2, 1);*/
        transition: all linear .4s;
    }

    .cat_father {
        display: inline-block;
        text-align: center;
        position: relative;
        /*height: 310px;*/
        vertical-align: top;
    }

    .category_main:hover + .cat_name {
        /*background-color: #88c2c4;*/
        background-color: #4d888a;
        color: #fff;
    }

    .active {
        animation-name: hide !important;
        -webkit-animation-name: hide !important;
    }

    .header-title .visuallyhidden {
        display: none;

    }

    .header-title .arabiclanguageanditsliterature-button {
        background-color: rgb(50, 66, 89);
    }

    .header-title .architectureconstructiion-button {
        background-color: rgb(255, 180, 0);
    }

    .header-title .artandheritage-button {
        background-color: rgb(191, 169, 152);
    }

    .header-title .astronomy-button {

    }

    .header-title .biologyandevolution-button {
        background-color: rgb(14, 73, 70);
    }

    .header-title .booksandreviews-button {
        background-color: rgb(95, 140, 168);
    }

    .header-title .chemistry-button {
        background-color: rgb(32, 96, 175);
    }

    .header-title .economics-button {
        background-color: rgb(70, 189, 163);
    }

    .header-title .engineeringandmachinery-button {
        background-color: rgb(152, 182, 203);
    }

    .header-title .graphicdesign-button {

    }

    .header-title .history-button {
        background-color: rgb(101, 76, 57);
    }

    .header-title .informationoffice-button {
        background-color: rgb(112, 210, 205);

    }

    .header-title .computerscience-button {
        background-color: rgb(35, 27, 81);
    }

    .header-title .linguistics-button {
        background-color: rgb(58, 101, 157);
    }

    .header-title .mathematics-button {
        background-color: rgb(199, 75, 47);
    }

    .header-title .medicine-button {
        background-color: rgb(177, 29, 44);
    }

    .header-title .multimedia-button {
        background-color: rgb(106, 106, 106);
    }

    .header-title .music-button {
        background-color: rgb(73, 44, 123);
    }

    .header-title .natureandecology-button {
        background-color: rgb(101, 195, 228);
    }

    .header-title .nutrition-button {
        background-color: rgb(32, 143, 45);
    }

    .header-title .philosophyandsocialsciences-button {
        background-color: rgb(37, 49, 133);
    }

    .header-title .physicsandastrology-button {
        background-color: rgb(136, 94, 124);
    }

    .header-title .psychology-button {
        background-color: rgb(163, 14, 98);
    }

    .header-title .publishing-button {

    }

    .header-title .scholarsandscholarship-button {
        background-color: rgb(196, 29, 63);
    }

    .header-title .scientificmethodology-button {
        background-color: rgb(7, 48, 105)
    }

    .header-title .scientificmisc-button {

    }

    .header-title .miscellaneoussciences-button {
        background-color: rgb(117, 205, 209);
    }

    .header-title .sports-button {

    }

    .header-title .syrianresearchandpublications-button {

        background-color: rgb(0, 111, 139)

    }

    .header-title .sexualeducation-button {
        background-color: rgb(108, 1, 123)
    }


    .title-button .v-avatar {
        position: absolute;
        right: -6%;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        height: 90px !important;
        width: 90px !important;

    }

    .category_main {
        height: 180px;
    }

    .categories_card .v-btn:not(.v-btn--round).v-size--default {
        background: transparent !important;
        color: #fff;
        border-radius: 24px;
    }

    .forward-button {
        background: rgba(255, 255, 255, 1);
        color: #444;
        border-radius: 30px;
        padding: 8px 16px !important;
        display: block;
        padding-right: 40px !important;
        position: relative;
        border: solid 1px #ddd;
        box-shadow: 1px 1px 8px 1px #ddd;
        transition: all linear 0.3s;
    }

    .forward-button:hover {
        background: rgba(0, 0, 0, 0.6);
        color: #fff;
    }

    .forward-button .v-icon.v-icon {
        color: #fff;
        position: absolute;
        right: 7px;
        font-size: 14px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.5);
        top: 5px;
    }

    .main__category {
        position: relative;
        min-width: 30%;
        margin-left: 5%;
    }

    .main__category__container {
        position: relative;
    }

    .category__icon {
        position: absolute;
        width: 70px;
        height: 70px;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    .category__details {
        background: rgba(255, 255, 255, 1);
        color: #444;
        border-radius: 56px;
        padding: 8px 70px !important;
        border: solid 1px #ddd;
        box-shadow: 1px 1px 8px 1px #ddd;
        padding-left: 20px !important;
        text-align: right;
    }

    .category__details p {
        margin: 0 !important;
    }

    .category__icon .v-image {
        width: 100%;
        height: 100%;
    }

    .category__icon .v-responsive__sizer {
        padding: 0 !important;
        width: 100%;
        height: 100%;
    }

    .category__icon .logo_replaced {
        background-color: rgb(36, 59, 88);
        border-radius: 50%;
        background-size: 90% auto;
        width: 80%;
        height: 80%;
        top: 10%;
        right: 10%;
    }

    .icon_container {
        position: absolute;
        left: 5%;
        text-align: left;
        bottom: 12%;
        width: 45px;
        height: 45px;
        padding: 0;
        bottom: 6.5%;
        transition: all linear 0.3s;
        border-radius: 50% !important;
    }

    .icon_container:hover {
        background: rgba(0, 0, 0, 0.5);
    }

    .responsive_members .theme--light {
        background: transparent;
        box-shadow: none !important;
    }

    .responsive_members .v-card__title {
        background-color: rgb(238, 238, 238) !important;
        border-radius: 40px !important;
        min-height: 0;
        padding: 8px 10px;
        margin-bottom: 16px;
    }

    .members-card .pa-1 {
        height: 100% !important;
        text-align: center !important;
        border-radius: 73px !important;
        margin-bottom: 0px;
    }

    .members-card .pa-1:last-child {
        margin-bottom: 22px;
    }

    .members-card .users-div {
        padding: 0 !important;
        position: relative;
    }

    .members-card .v-avatar {
        background-color: rgb(77, 136, 138);
        border-color: rgb(77, 136, 138);
        position: absolute;
        left: -4px;
        top: -12px;
    }

    .members-card .v-image__image {
        background-position: center center;
        border: solid 4px rgba(0, 0, 0, 0.7);
        border-radius: 50%;
    }

    .members-card .__float-left {
        font-size: 12px !important;
        min-width: 80% !important;
        text-align: right !important;
        margin: 0 !important;
        float: right;
        padding-right: 15px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-bottom: solid 1px #ddd;
    }

    .responsive_members .border-bottom {
        height: 150px;
        width: 100%;
        overflow: hidden;
    }

    .seems-articles .pa-2 a {
        width: 100%;
        height: 150px;
        overflow: hidden;
        border-radius: 15px;
        display: block;
        position: relative;
    }

    .seem-title {
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
        text-align: center;
        color: #fff;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 2;
        display: flex;
        align-items: center;
    }

    .seem-title span {
        text-align: center;
        display: block;
        width: 100%;
    }

    .v-card.sources {
        background: transparent;
        box-shadow: none !important;
    }

    .sources .v-card__title {
        text-align: right;
        padding: 15px 30px;
        background-color: rgb(52, 99, 122) !important;
        border-radius: 45px !important;
        margin-bottom: 15px !important;
        color: #fff;
        background-image: url(/image/home/header_call_bg.png);
        margin: 15px 0;
        position: relative;
        padding-right: 88px;
    }

    .sources .v-icon.v-icon {
        color: #fff;
        margin: 0 7px;
    }

    .sources a.v-btn--flat {
        color: #fff !important;
        margin: 0 15px;
        border: solid 1px #fff;
        border-radius: 50%;
        width: 35px;
        height: 35px;
    }

    .sources a .v-icon.v-icon {
        margin: 0;
        border: none;
        border-radius: 0;
    }

    .sources-icon {
        position: absolute !important;
        right: -8px;
        width: 80px;
        height: 80px;
        top: -9px;
        border-radius: 50%;
        background: rgb(52, 99, 122) !important;
        border: solid 2px #fff;
        font-size: 30px !important;
    }

    .source_name {
        border-bottom: solid 1px #ddd !important;
        border-radius: 0 !important;
    }

    .article_content .v-card:not(.v-sheet--tile):not(.v-card--shaped) {
        border-radius: 12px !important;
    }

    @keyframes hide {
        0% {
            display: block !important;
            opacity: 1;
        }
        99% {
            /*opacity: .3;*/
            display: block !important;
        }
        100% {
            opacity: 0;
            display: none !important;
        }
    }


    @-webkit-keyframes bounce {
        from,
        20%,
        53%,
        80%,
        to {
            -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        40%,
        43% {
            -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            -webkit-transform: translate3d(0, -30px, 0);
            transform: translate3d(0, -30px, 0);
        }

        70% {
            -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            -webkit-transform: translate3d(0, -15px, 0);
            transform: translate3d(0, -15px, 0);
        }

        90% {
            -webkit-transform: translate3d(0, -4px, 0);
            transform: translate3d(0, -4px, 0);
        }
    }

    @keyframes bounce {
        from,
        20%,
        53%,
        80%,
        to {
            -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        40%,
        43% {
            -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            -webkit-transform: translate3d(0, -30px, 0);
            transform: translate3d(0, -30px, 0);
        }

        70% {
            -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
            -webkit-transform: translate3d(0, -15px, 0);
            transform: translate3d(0, -15px, 0);
        }

        90% {
            -webkit-transform: translate3d(0, -4px, 0);
            transform: translate3d(0, -4px, 0);
        }
    }

    .__float-left {
        float: left;
    }

    .__float-right {
        float: right;
    }

    .article_content .v-image__image {
        background-position: 0 0 !important;
    }

    .header-title {
        position: relative;
    }

    .header-title h4 {
        background-color: rgb(52, 99, 122);
        color: #fff;
        border-radius: 40px;
        padding: 15px;
        padding-right: 15px;
        box-shadow: 0 3px 1px -2px rgba(0, 0, 0, .2), 0 2px 2px 0 rgba(0, 0, 0, .14), 0 1px 5px 0 rgba(0, 0, 0, .12);
        font-size: 20px;
        padding-right: 100px;
        background-image: url(/image/home/header_call_bg.png);
    }

    .header-title .v-image {
        position: absolute;
        top: 50%;
        right: -7px;
        width: 115px;
        height: 115px;
        transform: translateY(-50%);
    }

    .theme--light.v-card {
        overflow: hidden;
    }

    a.worker {
        display: block;
    }

    .border-bottom {
        border: solid 1px #ddd;
        border-radius: 5px;
    }

    .v-application p {
        margin-bottom: 0 !important;
    }

    .users-div {
        border-bottom: solid 1px #ddd;
    }

    .users-div:last-child {
        border-bottom: none;
    }

    @media (max-width: 958px) {
        .__float-left {
            float: none !important;
        }

        .__float-right {
            float: none;
        }

        .cat_sub_header {
            text-align: center !important;
            display: inline-block !important;
        }

        .display-flex {
            justify-content: center;
        }

        .responsive_members {
            margin: auto;
        }
    }
</style>