<template>
    <v-footer
            dark
            padless
    >
        <v-card
                flat
                tile
                class="footer_color indigo lighten-1 white--text text-center"
                style="width: 100%"
        >
            <div class="footer_bg">
            <v-card-text>
                <v-btn class="mr-2" text icon color="lighten-2" href="https://www.facebook.com" target="_blank">
                    <v-icon large>mdi-facebook-box</v-icon>
                </v-btn>
                <v-btn class="mr-2" text icon color="lighten-2" href="https://www.inestagram.com" target="_blank">
                    <v-icon large>mdi-instagram</v-icon>
                </v-btn>
                <v-btn class="mr-2" text icon color="lighten-2" href="https://www.facebook.com" target="_blank">
                    <v-icon large>mdi-twitter</v-icon>
                </v-btn>
                <v-btn class="mr-2" text icon color="lighten-2" href="https://www.facebook.com" target="_blank">
                    <v-icon large>mdi-linkedin-box</v-icon>
                </v-btn>
                <v-btn class="mr-2" text icon color="lighten-2" href="https://www.facebook.com" target="_blank">
                    <v-icon large>mdi-youtube</v-icon>
                </v-btn>
            </v-card-text>

            <v-card-text class="white--text pt-0">
                <v-row>
                    <v-col md="4" style="direction: rtl; text-align: right">

                        <b>روابط مهمة</b>
                        <ul class="mr-7 mb-2 mt-2">
                            <li> الشركاء التعليميون</li>
                            <li> حقوق الملكية</li>
                            <li> أسئلة مكررة</li>
                            <li>ميثاق الشرف</li>
                            <li> سياسة الكوكيز</li>
                            <li>شركاؤنا</li>
                            <li>دليل الشراكة</li>
                        </ul>

                    </v-col>
                    <v-col md="6" style="direction: rtl; text-align: right">
                        <div class="mb-4">
                            <b style="font-size: 20px">شركائنا</b>
                        </div>
                        <div class="partners">
                            <v-avatar color="white" size="100" class="shadow ma-1">
                                <v-img src="/image/home/unicef.png"
                                       aspect-ratio="1.7"
                                ></v-img>
                            </v-avatar>
                            <v-avatar color="white" size="100" class="shadow ma-1">
                                <v-img src="/image/home/idrak.png"
                                       aspect-ratio="1.7"
                                ></v-img>
                            </v-avatar>
                        </div>
                    </v-col>
                </v-row>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-text class="white--text">
                {{ new Date().getFullYear() }} — <strong>SYRIAN RESEARCHERS</strong>
            </v-card-text>
            </div>
        </v-card>

    </v-footer>
</template>
<script>
    export default {
        data: () => ({
            icons: [
                'fab fa-facebook',
                'fab fa-twitter',
                'fab fa-google-plus',
                'fab fa-linkedin',
                'fab fa-instagram',
            ],
        }),
    }
</script>
<style>
    footer {
        box-shadow: rgba(0, 0, 0, 0.4) 2px 5px 4px 7px;
    }
    .footer_color {
        background: linear-gradient(to top, #000, #3b3d42);;
    }
    .footer_bg{
        background-image: url(/image/home/header_call_bg.png);
        background-size: 100% auto;
        background-position: center bottom;
        background-repeat: no-repeat;
    }

    .shadow {
        -webkit-box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
        box-shadow: 7px -5px 15px -4px rgba(0, 0, 0, 0.75);
    }
    .partners .v-image__image{
        background-size: auto 61%;
    }
</style>