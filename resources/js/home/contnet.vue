<template>
    <div>
        <div>
            <!--####################Category#######################-->
            <v-row id="category" class="rtl_direction">
                <v-col cols="12">
                    <h1 style="text-align:center;padding: 10px;color:#4D888A;">الفئات</h1>
                </v-col>
                <div v-for="(cate,index) in category" :key="cate.id"
                     class="cat_father animated slideInUp delay-.5s col-md-3" :class="{'active':!show_cat}">
                    <div class="category_main animated jumbe_hover">
                        <v-menu>
                            <template v-slot:activator="{ on }">
                                <a class="responsive_link" v-on:click="click_category(index,cate.id)">
                                    <v-img v-if="cate.img" :src="'/image/'+cate.img" aspect-ratio="1.7" contain></v-img>
                                    <v-avatar v-else color="#4d888a" size="180" class="shadow">
                                        <v-img src="/image/home/logo_hd.png" contain></v-img>
                                    </v-avatar>
                                </a>
                            </template>
                        </v-menu>
                    </div>
                    <div class="title-button" :class="removeSpaces(cate.english_name) +'-button'">
                        <v-avatar>
                            <v-img v-if="cate.img" :src="'/image/'+cate.img" contain></v-img>
                            <v-img v-else src="/image/home/logo_hd.png" contain></v-img>
                        </v-avatar>
                        {{cate.name}}
                    </div>
                    <!--                    <p class="cat_name mt-5">{{cate.name}}</p>-->
                </div>
                <div style="clear: both"></div>
            </v-row>
        </div>
        <!--####################Sub Category Header#######################-->
        <v-row class="rtl_direction" :class="{'active':!show_sub_cat}" v-if="selected_cat_obj != null">
            <div class="text-center col-md-9 back_color cat_sub_header cat_sub_display">
                <div class="main__category">
                    <div class="main__category__container">
                        <div class="category__icon">
                            <v-img class="responsive_link_header" v-if="selected_cat_obj && selected_cat_obj.img"
                                   :src="'/image/'+selected_cat_obj.img"
                                   aspect-ratio="1.7" contain></v-img>
                            <v-img class="responsive_link_header logo_replaced" v-else src="/image/home/logo_hd.png"
                                   aspect-ratio="1.7"
                                   contain></v-img>
                        </div>
                        <div class="category__details">
                            <p v-if="selected_cat_obj">
                                الفئة:
                                {{selected_cat_obj.name}}
                            </p>
                            <p>
                                عدد الفئات الفرعية:
                                {{sub_cat_count}}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 mb-5" style="clear:both">
                        <a class=" forward-button"
                           v-on:click="back_to_category">
                            <v-icon class="animated infinite delay-2s">mdi-skip-forward</v-icon>
                            عودة إلى الفئات الرئيسية

                        </a>
                    </div>
                </div>

                <div id="show_sub_selected" style="display:none" class="main__category">
                    <div class="main__category__container">
                        <div class="category__icon">
                            <v-img class="responsive_link_header"
                                   v-if="selected_sub_cat_inArray != null && sub_categories[selected_sub_cat_inArray].img"
                                   :src="'/image/'+sub_categories[selected_sub_cat_inArray].img" aspect-ratio="1.7"
                                   contain></v-img>

                            <v-img v-else class="responsive_link_header logo_replaced" src="/image/home/logo_hd.png"
                                   aspect-ratio="1.7"
                                   contain></v-img>
                        </div>
                        <div class="category__details" v-if="selected_sub_cat_inArray != null">
                            <p style="display: block">
                                الفئة الفرعية:
                                {{sub_categories[selected_sub_cat_inArray].name}}
                            </p>
                            <p style="display: block">
                                عدد المقالات في الفئة:
                                {{articles.length}}
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 mb-5" style="clear:both" v-if="selected_sub_cat_inArray != null">
                        <a class="forward-button"
                           v-on:click="back_from_art_to_sub">
                            <v-icon class="animated infinite delay-2s">mdi-skip-forward</v-icon>
                            عودة إلى الفئات الفرعية
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-md-3 back_color __float-left cat_sub_header"
                 v-if="selected_cat_obj">
                <h1 class="mb-5">إدارة القسم</h1>
                <div v-for="(admin,index) in category_admin" :key="admin.id" class="mb-4 display-flex">
                    <router-link :to="'/user/'+admin.id" class="worker">
                        <h4 class="float-right mt-4 ml-4 cate_admin_name">{{admin.name}}</h4>
                        <v-avatar color="#4d888a" size="60" class="shadow">
                            <v-img v-if="admin.img" :src="'/image/'+admin.img" contain></v-img>
                            <v-img v-else src="/image/home/logo_hd.png" contain></v-img>
                        </v-avatar>
                    </router-link>
                </div>
            </div>
            <!--#################################### Sub Category  ############################  -->
            <div id="sub_cate" class="col-md-12">
                <v-col cols="12">
                    <h1 style="text-align:center;padding: 25px 0;color:#4D888A;">الفئات الفرعية</h1>
                </v-col>
                <div :class="{'active':!show_sub_cat}" v-for="(sub_cate,index) in sub_categories"
                     :key="sub_cate.id"
                     class="cat_father animated slideInUp delay-.5s col-md-3">
                    <div class="category_main animated jumbe_hover">
                        <v-menu>
                            <template v-slot:activator="{ on }">
                                <a v-on:click="click_sub_category(index,sub_cate.id)">
                                    <v-img v-if="sub_cate.img" :src="'/image/'+sub_cate.img" contain></v-img>
                                    <v-avatar v-else color="#4d888a" size="180" class="shadow">
                                        <v-img src="/image/home/logo_hd.png" contain></v-img>
                                    </v-avatar>
                                </a>
                            </template>
                        </v-menu>
                    </div>
                    <!--                    <p class="cat_name mt-5">{{sub_cate.name}}</p>-->
                    <div class="title-button with-shadow" :class="removeSpaces(sub_cate.name) +'-button'">
                        <v-avatar>
                            <v-img v-if="sub_cate.img" :src="'/image/'+sub_cate.img" contain></v-img>
                            <v-img v-else src="/image/home/logo_hd.png" contain></v-img>
                        </v-avatar>
                        {{sub_cate.name}}
                    </div>
                </div>
            </div>
            <div style="clear: both"></div>
        </v-row>
        <!--####################Articles#######################-->
        <v-row id="articles" class="rtl_direction">
            <div id="all_articles" style="width: 100%; display: none">
                <h1 style="text-align:center;padding: 10px;color:#4D888A;">مقالات الفئة</h1>
                <!--                    <div :class="{'active':!show_articles}" v-for="(article,index) in articles" :key="article.id"-->
                <!--                         class="cat_father animated slideInUp delay-.5s col-md-3 col-sm-6">-->
                <!--                        <v-hover v-slot:default="{ hover }">-->
                <!--                            <div class="category_main animated jumbe_hover"-->
                <!--                                 :class="{ 'on-hover': hover }">-->
                <!--                                <v-menu>-->
                <!--                                    <template v-slot:activator="{ on }">-->
                <!--                                        <router-link :to="'/article/'+article.id">-->
                <!--                                            <v-img v-if="article.home_picture"-->
                <!--                                                   class="shadow"-->
                <!--                                                   :src="'/image/'+article.home_picture.path"-->
                <!--                                                   aspect-ratio="2"></v-img>-->
                <!--                                            <v-avatar v-else color="#4d888a" size="180" class="shadow">-->
                <!--                                                <v-img src="/image/home/logo_hd.png" contain></v-img>-->
                <!--                                            </v-avatar>-->
                <!--                                        </router-link>-->
                <!--                                    </template>-->
                <!--                                </v-menu>-->
                <!--                                <div style="position: absolute;top: 10px;left: 10px; color: transparent"-->
                <!--                                     :class="{ 'show-btns': hover }">-->
                <!--                                    <p>-->
                <!--                                        {{article.desktop_views}}-->
                <!--                                        <v-icon v-if="hover" color="white" size="15">mdi-eye</v-icon>-->
                <!--                                    </p>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </v-hover>-->
                <!--                        &lt;!&ndash;                    <p class="cat_name mt-5">{{article.title}}</p>&ndash;&gt;-->
                <!--                        <div class="title-button">-->
                <!--                            <v-avatar>-->
                <!--                                <v-img v-if="article.img" :src="'/image/'+article.img" contain></v-img>-->
                <!--                                <v-img v-else src="/image/home/logo_hd.png" contain></v-img>-->
                <!--                            </v-avatar>-->
                <!--                            {{article.name}}-->
                <!--                        </div>-->
                <!--                    </div>-->
                <div style="padding: 0 15px">
                    <div :class="{'active':!show_articles} " v-for="(article,index) in articles" :key="article.id"
                         class="cat_father animated slideInUp delay-.5s col-md-3 col-sm-6 col">
                        <v-card style="direction: rtl; text-align:right" class="mx-auto latest_article" max-width="400">
                            <v-img v-if="article.home_picture"
                                   class="shadow"
                                   :src="'/image/'+article.home_picture.path"
                                   aspect-ratio="2">
                            </v-img>
                            <v-avatar v-else color="#4d888a" size="180" class="shadow">
                                <v-img src="/image/home/logo_hd.png" contain></v-img>
                            </v-avatar>

                            <v-card-title>
                                <v-btn class="full-button" text :to="'/article/'+article.id">
                                    <span>{{article.title.substring(0,40) + '...'}}</span>
                                </v-btn>
                            </v-card-title>

                            <div class="desktop_views">
                                {{article.desktop_views}}
                                <v-icon color="white" size="15">mdi-eye</v-icon>
                            </div>
                            <v-card-actions class="icon_container">
                                <v-btn color="blue" text :to="'/article/'+article.id">
                                    <span class="v-icon notranslate mdi mdi-link theme--light link_icon"></span>
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>
        </v-row>
        <v-divider></v-divider>


        <div style="text-align:center" class="mt-4" v-if="!theArticle">
            <v-btn style="background-color: #444 !important; " class="show_more mb-4" @click="show_more(content_more)" :disabled="btn_disabled">
                <span class="" v-if="show">
                    عرض المزيد
                </span>
                <i  v-else style="color: #fff;" class="fa fa-spinner fa-spin fa-2x" ></i>
            </v-btn>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            cat_id_prop: '',
        },
        data() {
            return {
                has_error: false,
                success: false,

                errors: [],
                category: [],
                category_admin: [],
                sub_categories: [],
                sub_cat_count: '',
                articles: [],

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

                offset: 0,
                sub_offset: 0,
                article_offset: 0,

                btn_disabled: false,
                show: true,
                show_cat: true,
                show_sub_cat: false,
                show_articles: false,

                selected_cat_inArray: null,
                selected_cat_obj: null,
                selected_sub_cat_inArray: null,
                selected_article_inArray: null,

                content_more: 'category'
            }
        },
        methods: {
            removeSpaces(str) {
                str = str.toLowerCase().trim();
                str = str.replace(/\s/g, '');
                return str;
            },

            getcategories() {
                let formData = new FormData();
                formData.append('offset', this.offset);
                console.log(this.offset);
                this.show = false;
                this.axios.post('category/show', formData,
                ).then((response) => {
                    this.has_error = false;
                    this.offset += 4;
                    if (Array.isArray(response.data.data.categories) && response.data.data.categories.length) {
                        response.data.data.categories.forEach(element => this.category.push(element));
                        this.show = true;
                    } else {
                        this.show = true;
                        this.btn_disabled = true;
                    }
                    this.message = response.data.data.message;
                }).catch((err) => {
                    this.has_error = true;
                    this.success = false;
                    this.message = err.message;
                    this.errors = err.response.data.errors;
                });
            },
            get_sub_categories() {
                let formData = new FormData();
                formData.append('sub_offset', this.sub_offset);
                this.axios.post('category/get-sub-list/' + this.selected_cat, formData
                ).then((response) => {
                    this.has_error = false;
                    if (Array.isArray(response.data.data.sub_categories) && response.data.data.sub_categories.length) {
                        response.data.data.sub_categories.forEach(element => this.sub_categories.push(element));
                        this.show = true;
                        this.sub_offset += 4;
                    } else {
                        this.show = true;
                        this.btn_disabled = true;
                    }
                    this.message = response.data.data.message;
                }).catch((err) => {
                    this.has_error = true;
                    this.success = false;
                    this.message = err.message;
                    this.errors = err.response.data.errors;
                });
            },
            get_articles() {
                let formData = new FormData();
                formData.append('article_offset', this.article_offset);
                this.axios.post('article/byCategory/' + this.selected_sub_cat, formData).then((res) => {
                    if (Array.isArray(res.data.data.articles) && res.data.data.articles.length) {
                        res.data.data.articles.forEach(element => this.articles.push(element));
                        this.show = true;
                        this.article_offset += 4;
                    } else {
                        this.show = true;
                        this.btn_disabled = true;
                    }
                    this.has_error = false;
                    this.message = res.data.data.message;
                }).catch((err) => {
                    this.has_error = true;
                    this.success = false;
                    this.message = err.message;
                    this.errors = err.response.data.errors;
                });
            },
            get_category_admin() {
                this.axios.get('category/admin/' + this.selected_cat).then((res) => {
                    this.category_admin = res.data.data.admin;
                    this.selected_cat_obj = res.data.data.category;
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
            click_category(array_index, cate_id) {
                this.show_cat = false;
                this.show_sub_cat = false;
                this.show_articles = false;
                this.selected_cat_inArray = array_index;
                this.selected_cat = cate_id;
                this.content_more = 'subcategory';
                this.show = true;
                this.sub_offset = 0;
                this.sub_categories = [];
                this.btn_disabled = false;
                this.get_category_admin();
                this.get_sub_categories();
                this.show_sub_cat = true;
                setTimeout(function () {
                    $('#category').slideUp(500, function () {
                        $('.cat_sub_header').slideDown(200);
                        $('#sub_cate').slideDown(500);
                    })
                }, 900);
            },
            click_sub_category(array_index, sub_cate_id) {
                this.show_cat = false;
                this.show_articles = false;
                this.selected_sub_cat_inArray = array_index;
                this.selected_sub_cat = sub_cate_id;
                this.content_more = 'article';
                this.article_offset = 0;
                this.articles = [];
                this.get_articles();
                this.show_articles = true;
                setTimeout(
                    function () {
                        $('#sub_cate').slideUp(500, function () {
                            $('#show_sub_selected').slideDown(200);
                            $('#articles').slideDown(300);
                            $('#all_articles').slideDown(300);
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
            back_to_category() {
                this.show_sub_cat = false;
                this.content_more = 'category';
                this.show = true;
                this.btn_disabled = false;
                this.selected_sub_cat_inArray = null;
                var local = this;
                setTimeout(function () {
                    $('#sub_cate').slideUp(500, function () {
                        local.show_cat = true;
                        $('.cat_sub_header').slideUp(200);
                        $('#articles').slideUp(300);
                        $('#category').slideDown(500);
                    })
                }, 900);
            },
            back_from_art_to_sub() {
                if (this.theArticle != null) {
                    var local = this;
                    $('#theArticle').slideUp(1000, function () {
                        local.theArticle = null;
                    });
                }
                this.show_articles = false;
                this.show_cat = false;
                this.show_sub_cat = true;
                this.content_more = 'subcategory';
                this.show = true;
                this.btn_disabled = false;
                var local = this;
                setTimeout(function () {
                    $('#show_sub_selected').slideUp(500, function () {
                        $('#articles').slideUp(300);
                        local.show_cat = true;
                        $('#sub_cate').slideDown(500);
                    })
                }, 900);
            },
        },
        created() {
            this.getcategories();
        },
        mounted() {
            if (this.cat_id_prop) {
                this.selected_cat = this.cat_id_prop;
                this.click_category(null, this.selected_cat);
                this.get_category_admin();
            }
        },
    }
</script>


<style scoped>
    @import "../../sass/animate.css";
    .cat_father .latest_article .v-card__title {
        height: 100%;
        padding: 10px;
        top: 0;
        left: 0;
        width: 100%;
        border-radius: 0;
        box-sizing: border-box;
        bottom: auto;
        display: block;
    }

    .cat_father .latest_article .v-card__title span {
        text-align: center;
        position: absolute;
        top: 50%;
        width: 100%;
        transform: translateY(-50%);
        left: 0;
    }

    .__float-left {
        float: left;
    }

    .__float-right {
        float: right;
    }

    .rtl_direction {
        direction: rtl;
    }

    .show_more {
        letter-spacing: normal !important;
    }

    .back_color {
        /*background-color: #eee;*/
    }

    .cate_admin_name {
        min-width: 45%;
    }

    .cat_sub_display {
        display: flex;
        justify-content: center;
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
        background-color: rgb(36, 59, 88) !important;
    }

    .avatar_shadow {
        -webkit-box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
        box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
    }

    .jumbe_hover:hover {
        -webkit-animation-name: pulse;
        animation-name: pulse;
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

    .worker {
        color: #555;
    }

    .worker:hover {
        color: black;
    }

    .display-flex {
        display: flex;
    }

    .active {
        animation-name: hide !important;
        -webkit-animation-name: hide !important;
    }

    .visuallyhidden {
        display: none;

    }

    .title-button {
        width: 90%;
        margin: 15px auto;
        background-color: rgb(36, 59, 88);
        color: #fff;
        border-radius: 40px;
        position: relative;
        line-height: 3.5;
        margin-top: 30px;
        background-image: url(/image/home/header_call_bg.png);
        text-indent: 45px;

    }

    .categories_card .v-btn:not(.v-btn--round).v-size--default.full-button {
        display: flex;
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        position: absolute;
        left: 0;
        top: 0;
        align-items: center;
        color: #fff !important;
        font-size: 18px;
        font-weight: bold;
    }

    .title-button.with-shadow .v-avatar {
        box-shadow: 10px 0px 4px -6px rgba(0, 0, 0, .5);
    }
    .theme--light.v-btn.v-btn--disabled.show_more:not(.v-btn--flat):not(.v-btn--text):not(.v-btn--outlined) {
        background-color: rgba(0,0,0,0.8)!important;
    }

    .title-button .v-image__image {
        background-color: rgb(58, 111, 178);
    }

    .arabiclanguageanditsliterature-button {
        background-color: rgb(50, 66, 89);
    }

    .architectureconstructiion-button {
        background-color: rgb(255, 180, 0);
    }

    .artandheritage-button {
        background-color: rgb(191, 169, 152);
    }

    .astronomy-button {

    }

    .biologyandevolution-button {
        background-color: rgb(14, 73, 70);
    }

    .booksandreviews-button {
        background-color: rgb(95, 140, 168);
    }

    .chemistry-button {
        background-color: rgb(32, 96, 175);
    }

    .economics-button {
        background-color: rgb(70, 189, 163);
    }

    .engineeringandmachinery-button {
        background-color: rgb(152, 182, 203);
    }

    .graphicdesign-button {

    }

    .history-button {
        background-color: rgb(101, 76, 57);
    }

    .informationoffice-button {
        background-color: rgb(112, 210, 205);

    }

    .computerscience-button {
        background-color: rgb(35, 27, 81);
    }

    .linguistics-button {
        background-color: rgb(58, 101, 157);
    }

    .mathematics-button {
        background-color: rgb(199, 75, 47);
    }

    .medicine-button {
        background-color: rgb(177, 29, 44);
    }

    .multimedia-button {
        background-color: rgb(106, 106, 106);
    }

    .music-button {
        background-color: rgb(73, 44, 123);
    }

    .natureandecology-button {
        background-color: rgb(101, 195, 228);
    }

    .nutrition-button {
        background-color: rgb(32, 143, 45);
    }

    .philosophyandsocialsciences-button {
        background-color: rgb(37, 49, 133);
    }

    .physicsandastrology-button {
        background-color: rgb(136, 94, 124);
    }

    .psychology-button {
        background-color: rgb(163, 14, 98);
    }

    .publishing-button {

    }

    .scholarsandscholarship-button {
        background-color: rgb(196, 29, 63);
    }

    .scientificmethodology-button {
        background-color: rgb(7, 48, 105)
    }

    .scientificmisc-button {

    }

    .miscellaneoussciences-button {
        background-color: rgb(117, 205, 209);
    }

    .sports-button {

    }

    .syrianresearchandpublications-button {

        background-color: rgb(0, 111, 139)

    }

    .sexualeducation-button {
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
        margin: 0;
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

    .latest_article {
        border-radius: 20px !important;
        box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.5);
        height: 300px;
        direction: rtl;
        text-align: right;
        overflow: hidden;
        padding: 0;
    }

    .latest_article .v-image {
        height: 100%;
    }

    .latest_article .v-card__title {
        width: 96%;
        background: rgba(0, 0, 0, 0.4);
        color: #fff;
        font-weight: bold;
        left: 2%;
        border-radius: 60px;
        bottom: 3%;
        position: absolute;
    }

    .latest_article .v-image__image--cover {
        background-size: cover;
        background: url("/image/home/home.jpg") center no-repeat !important;
        background-size: auto;
        background-size: 100% 100% !important;
        filter: none;
        border-radius: 0;
    }

    .latest_article .v-card__title {
        width: 96%;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        font-weight: bold;
        left: 2%;
        border-radius: 60px;
        bottom: 3%;
    }

    .icon_container a {
        transform: rotate(-50deg);
        margin-top: -2px;
        cursor: pointer;
        position: absolute !important;
        top: 6px;
        left: -10px;
        height: 35px;
        width: 20px;
        color: #fff !important;
    }

    .icon_container .v-btn::before {
        background: transparent;
        border-radius: 50% !important;
        width: 45px !important;
        height: 45px !important;
    }

    .latest_article .v-image__image {
        background-size: auto 100%;
    }

    .latest_article:hover .v-image__image {

        background-size: auto 110%;

    }

    .desktop_views {
        position: absolute;
        top: 10px;
        left: 10px;
        color: #fff;
        line-height: 1;
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

    @media (max-width: 958px) {
        .__float-left {
            float: none !important;
        }

        .responsive_link {
            display: inline-block;
            margin: auto;
        }

        .responsive_link > div {
            width: 300px;
        }

        .responsive_link_header {
            width: 300px;
            margin: auto;
        }

        .__float-right {
            float: none;
        }

        .cat_sub_header {
            text-align: center !important;
            display: inline-block;
        }

        .display-flex {
            justify-content: center;
        }

        .cat_name {
            width: 50%;
            margin: auto;
        }
    }

</style>