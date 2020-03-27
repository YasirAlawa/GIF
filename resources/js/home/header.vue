<template>
    <div>
        <v-toolbar
                dark
                prominent
                src="/image/home/vbanner.jpg">
                <v-row class="logo-row">
                        <v-btn text icon color="lighten-2" href="https://www.facebook.com" target="_blank">
                            <v-icon large>
                                mdi-facebook-box
                            </v-icon>
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
            <v-img
                    height="100%"
                    width="100%"
                    src="/image/home/header_char.png"
                    aspect-ratio="3"
                    style="position: absolute; z-index: -1"
            ></v-img>
            <v-spacer></v-spacer>
            <p class="header_title" style="max-width: 30%">سنعيد كتابة العلم بأبجدية عربية</p>
            <v-img
                    height="90%"
                    src="/image/home/top-logo.png"
                    aspect-ratio="3"
                    contain
                    position="right"
                    style="min-width: 30%"
                    class="logo_hover"
                    @click="$router.push({name: 'home'})"
            ></v-img>
        </v-toolbar>
    </div>
</template>
<style scoped>
    .header_title {
        font-size: 16px;
        margin-top: 86px;
        margin-right: -93px;
    }

    .logo_hover:hover {
        cursor: pointer;
    }
    @media (max-width: 768px)   {
        .header_title{
            display: none;
        }
        .logo_hover{
            min-width: 96% !important;
        }
        .logo-row{
            position: absolute;
            bottom: 0;
            z-index: 10;
        }
        .logo-row .v-btn span  i {
            font-size: 25px !important;
        }
        .logo-row .v-btn{
            width: auto !important;
        }
    }
</style>