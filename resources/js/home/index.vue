<template>
    <div>
        <!--        <app-header></app-header>-->
        <app-home-header></app-home-header>
        <section class="home_section">
            <div class="header_title_container">
                <p class="header_title">سنعيد كتابة العلم بأبجدية عربية</p>
            </div>
            <div class="home_image"></div>
            <div class="More"
                 style="position: absolute;bottom: 30px;left: 50%;transform: translateX(-50%);width: 55px;height: 55px;border-radius: 50%;background: rgba(0,0,0,0.5);cursor: pointer;align-content: ;">
                <span style="text-align: center;display: block;line-height: 55px;color: #fff;opacity: 0.7;font-size: 24px;"
                      class="v-icon notranslate mdi mdi-arrow-down theme--light"></span>
            </div>
        </section>
        <section class="latest_section">
            <h1 data-v-ba29cc0e=""
                style="text-align: center; padding: 40px 0; color: rgb(77, 136, 138);font-size: 36px;font-weight: bold;">
                أحدث المواضيع</h1>
            <v-row style="padding:0 15px;">
                <v-col v-for="row in latest" class="col-md-3"
                       :key="row.id">
                    <v-card style="direction: rtl; text-align:right" class="mx-auto latest_article" max-width="400">
                        <v-img :src="'/image/'+row.home_picture.path"></v-img>
                        <v-card-title>{{row.title.substring(0,15) + '...'}}</v-card-title>
                        <v-card-actions class="icon_container">
                            <v-btn color="blue" text :to="'/article/'+row.id">
                                <span class="v-icon notranslate mdi mdi-link theme--light link_icon"></span>
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </section>
        <div id="content" class="control-panel">
            <v-row>
                <v-col
                        cols="12"
                >
                    <v-card class="pa-1 categories_card">
                        <app-content
                                :cat_id_prop="cat_id_prop"
                        ></app-content>
                    </v-card>
                </v-col>
            </v-row>
        </div>
        <v-img src="/image/home/team_bg.jpg"
               lazy-src="/image/home/team_bg.jpg"
               class="grey lighten-2"
               aspect-ratio="2" height="600" style="
    box-shadow: 1px 0px 7px 4px rgba(0,0,0,0.2);">
            <v-row
                    class="fill-height ma-0"
                    align="center"
                    justify="center"
            >
                <h1 style="font-size:60px; color:#55627b;text-align:center;text-shadow: -9px 7px 5px #7A7A7AC7;">
                    أكثر من 450 متطوعا<br/>
                    قصة نجاح</h1>
            </v-row>
            <template v-slot:placeholder>
                <v-row
                        class="fill-height ma-0"
                        align="center"
                        justify="center"
                >
                    <v-progress-circular indeterminate color="red lighten-3"></v-progress-circular>
                </v-row>
            </template>
        </v-img>
        <v-row class="pa-5" style="padding: 60px 0 !important;" id="counter">
            <div class="fake-div"></div>
            <v-hover>
                <v-col cols="3"
                       slot-scope="{hover}"
                       class="fill-height ma-0"
                       align="center"
                       justify="center">
                    <v-icon
                            :class="`${hover? 'animated bounce delay-.5s' :''}`"
                            size="60" color="green">person
                    </v-icon>
                    <div class="counter-value" data-count="450" style="color: #4caf50;">0</div>
                    <h2>أكثر من 450 متطوعاً</h2>
                </v-col>
            </v-hover>
            <v-hover>
                <v-col cols="3"
                       slot-scope="{hover}"
                       class="fill-height ma-0"
                       align="center"
                       justify="center">
                    <v-icon
                            size="60"
                            color="orange"
                            :class="`${hover? 'animated heartBeat delay-.5s' :''}`">contact_support
                    </v-icon>
                    <div class="counter-value" data-count="100" style="color: #ff9800;">0</div>
                    <h2>مئة سؤال يومي من متابعينا</h2>
                </v-col>
            </v-hover>
            <v-hover>
                <v-col cols="3"
                       slot-scope="{hover}"
                       class="fill-height ma-0"
                       align="center"
                       justify="center">
                    <v-icon
                            size="60"
                            color="red"
                            :class="`${hover? 'animated heartBeat delay-.5s' :''}`">fingerprint
                    </v-icon>
                    <div class="counter-value" data-count="194444" style="color: #f44336">80000</div>
                    <h2>ما يقارب الـ(19444) موضوع علمي</h2>
                </v-col>
            </v-hover>

            <v-hover>
                <v-col cols="3"
                       slot-scope="{hover}"
                       class="fill-height ma-0"
                       align="center"
                       justify="center">
                    <v-icon
                            size="60"
                            color="blue"
                            :class="`${hover? 'animated bounce delay-.5s' :''}`">thumb_up
                    </v-icon>
                    <div class="counter-value" data-count="1000000" style="color: #2196f3">700000</div>
                    <h2>أكثر من مليون زائر شهرياً</h2>
                </v-col>
            </v-hover>
            <div class="fake-div"></div>
        </v-row>
        <app-footer></app-footer>
    </div>
</template>

<script>
    import Header from './header.vue';
    import HomeHeader from './Homeheader.vue';
    import Footer from './footer.vue';
    import Content from './contnet.vue';


    export default {
        name: 'home',
        props: {
            cat_id_prop: '',
        },
        components: {
            appHeader: Header,
            appHomeHeader: HomeHeader,
            appFooter: Footer,
            appContent: Content,
        },
        data() {
            return {
                has_error: false,
                success: true,
                message: '',
                errors: [],
                welcome: 'This is your profile',
                cat_id: null,
                sub_cat_id: null,
                sub_categories: [],
                latest: {},
            }
        },
        mounted() {
            if (this.cat_id_prop) {
                this.cat_id = this.cat_id_prop;
                this.sub_cat_id = this.sub_cat_id_prop;
            }

        },
        methods: {
            getLatesetArticles() {
                this.axios.get('articles/latest').then((res) => {
                    this.latest = res.data.data;
                    console.log(res.data.data)
                }).catch((err) => {
                    this.has_error = true;
                    this.success = false;
                    this.message = err.message;
                    this.errors = err.response.data.errors;
                });
            }
        },
        created() {
            this.getLatesetArticles();
            var a = 0;
            $(window).scroll(function () {
                var oTop = $('#counter').offset().top - window.innerHeight;
                if (a == 0 && $(window).scrollTop() > oTop) {
                    $('.counter-value').each(function () {
                        var $this = $(this),
                            countTo = $this.attr('data-count');
                        $({
                            countNum: $this.text()
                        }).animate({
                                countNum: countTo
                            },

                            {

                                duration: 3000,
                                easing: 'swing',
                                step: function () {
                                    $this.text(Math.floor(this.countNum));
                                },
                                complete: function () {
                                    $this.text(this.countNum);
                                    //alert('finished');
                                }

                            });
                    });
                    a = 1;
                }

            });
        }
    }
</script>
<style scoped>
.home_image {
        position: absolute;
        height: 100vh;
        top: 0;
        left: 0;
        width: 100%;
        box-shadow: 1px -2px 6px 4px rgba(0,0,0,0.4);
    }

    .home_image::after {
        content: "";
        background: url("/image/home/home.jpg") center no-repeat !important;
        background-size: cover !important;
        opacity: 1;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
    }

    .More:after {
        content: "";
        width: 0;
        height: 0;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        border: solid 3px rgba(0, 0, 0, 0.3);
        box-sizing: border-box;
        transition: all linear 0.3s;
        z-index: 1;
    }

    .More:hover:after {
        width: 65px;
        height: 65px;
        opacity: 1;

    }

    .More:before {
        content: "";
        width: 0;
        height: 0;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        border: solid 3px rgba(0, 0, 0, 0.3);
        box-sizing: border-box;
        transition: all linear 0.5s;
        z-index: 1;
    }

    .More:hover:before {
        width: 75px;
        height: 75px;
        opacity: 1;

    }
    .categories_card {

        box-shadow: none !important;
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
        background: rgba(0, 0, 0, 0.5);
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

    .fill-height h2 {
        margin-top: 30px;
        color: #444;
    }

    .counter-value {
        margin: 30px 0;
        font-size: 28px;
        font-weight: bolder;
        color: #f4534b;
    }

    @media (max-width: 958px) {
        h2 {
            font-size: 15px;
        }
    }

    @media (max-width: 768px) {
        .header_title {
            /*display: none;*/
            font-size: 25px;
        }

        .logo_hover {
            min-width: 96% !important;
        }

        .logo-row {
            position: absolute;
            bottom: 0;
            z-index: 10;
        }

        .logo-row .v-btn span i {
            font-size: 25px !important;
        }

        .logo-row .v-btn {
            width: auto !important;
        }
        #counter .fill-height{
            max-width: 50%;
            flex: 0 0 50%;
        }
    }
</style>
