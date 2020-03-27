<template>
    <div>
        <div>
            <v-toolbar
                    flat
                    prominent
                    color="#0000001c"
                    style="z-index:15">
                <v-row class="logo-row">
                    <v-btn text icon color="lighten-2" href="https://www.facebook.com" target="_blank">
                        <v-icon large> mdi-facebook-box</v-icon>
                    </v-btn>
                    <v-btn text icon color="lighten-2" href="https://www.inestagram.com" target="_blank">
                        <v-icon large>mdi-instagram</v-icon>
                    </v-btn>
                    <v-btn text icon color="lighten-2" href="https://www.facebook.com" target="_blank">
                        <v-icon large>mdi-twitter</v-icon>
                    </v-btn>
                    <v-btn text icon color="lighten-2" href="https://www.facebook.com" target="_blank">
                        <v-icon large>mdi-linkedin-box</v-icon>
                    </v-btn>
                    <v-btn text icon color="lighten-2" href="https://www.facebook.com" target="_blank">
                        <v-icon large>mdi-youtube</v-icon>
                    </v-btn>
                </v-row>
<!--                <ul class="main-menu">-->
<!--                    <li><a href=""> <v-icon large>mdi-home</v-icon></a></li>-->
<!--                    <li><a href="">من نحن</a></li>-->
<!--                    <li><a href="">الفئات</a></li>-->
<!--                    <li><a href="">الباحثون السوريون TV</a></li>-->
<!--                    <li><a href="">اتصل بنا</a></li>-->
<!--                </ul>-->
                <v-spacer></v-spacer>
                <v-img src="/image/home/top-logo.png" class="logo_hover" @click="$router.push({name: 'home'})"></v-img>
            </v-toolbar>
        </div>

    </div>
</template>
<style>
    section.home_section {
        position: relative;
        height: 100vh;
    }

    .header_title_container {
        height: 370px;
        display: block;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 45px;
        position: absolute;
        width: 100%;
        height: auto;
        transform: translateY(-50%);
        top: 50%;
        z-index: 99;
        text-align: center;
    }

    header.theme--light.v-toolbar.v-sheet {
        height: 70px !important;
        background-image: url(/image/home/header_call_bg.png);
        background-color: rgba(0, 0, 0, 0.7) !important;
        border-color: rgba(0, 0, 0, 0.11) !important;
        width: 90%;
        margin: auto;
        margin-top: auto;
        border-radius: 90px;
        margin-top: 30px;
        position: fixed;
        left: 5%;
        top: 0;
    }

    header.v-toolbar--flat .v-toolbar__content {
        height: 75px !important;
        padding: 4px 8px;
    }

    .logo-row {
        padding-top: 8px;
        padding-left: 40px;

    }

    .logo_hover {
        display: block !important;
        height: 100%;
        padding: 0;
        margin: 0;
        min-width: 100px;
        width: 262px;
        flex: none !important;
    }

    .logo_hover .v-responsive__sizer {
        padding: 0 !important;
    }

    .logo_hover .v-image__image--cover {
        background-size: 100% auto !important;
        width: 100%;
        background-position: right 0 !important;
    }


    .header_title {
        text-shadow: -9px 7px 5px #7A7A7AC7;
        color: #FFF;
        direction: rtl;
        text-align: center;
        font-weight: bolder;
    }

    .logo_hover:hover {
        cursor: pointer;
    }

    .v-toolbar__content .v-btn.v-btn--icon.v-size--default,
    .v-toolbar__extension .v-btn.v-btn--icon.v-size--default {
        height: 48px;
        width: 48px;
        color: #fff;
    }

    .v-btn--outlined .v-btn__content .v-icon, .v-btn--round .v-btn__content .v-icon {
        color: currentColor;
        font-size: 24px !important;
    }


    header .v-btn:before {
        background-color: rgba(0, 0, 0, 0.6);
    }

    header .theme--light.v-btn:hover:before {
        opacity: 1;
    }
</style>
<script>
    export default {
        mounted() {
            $(document).ready(function () {
                $(".More").click(function () {
                    $("html,body").animate({scrollTop:$(".latest_section").offset().top}, '2000');
                })
            })

        },
    }
</script>