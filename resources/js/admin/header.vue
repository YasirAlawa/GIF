<template>
    <div class="mb-10">
        <v-app-bar dark>
            <v-toolbar-title>
                
                GIF Browsing
            </v-toolbar-title>
            <router-link to="/image">
                <v-btn class="mr-4" color="normal">New Image</v-btn>
            </router-link>
            <router-link to="/history">
                <v-btn class="mr-4" color="normal">History</v-btn>
            </router-link>
            <v-spacer></v-spacer>
            <template>
                <v-menu id="profile_img">
                    <template  v-slot:activator="{ on }">
                        <a
                                v-on="on"
                        >
                        <div  >
                        <v-list-item-avatar size="40" >
                                <v-img v-if="img" :src="'/image/'+img"></v-img>
                                <v-img v-else
                                       src="/image/members/logo.png"
                                       contain
                                       position="center"></v-img>
                        </v-list-item-avatar>
                            <v-icon style="margin-left: -17px">arrow_drop_down</v-icon>
                        </div>
                        </a>
                    </template>
                    <v-list>
                        <v-list-item>
                            <v-list-item-title >
                                    <v-icon  color="yellow">emoji_emotions</v-icon>
                                    {{$auth.user().user.name}}
                            </v-list-item-title>
                        </v-list-item>
                        <v-divider></v-divider>

                        

                        <v-list-item
                                @click="$auth.logout()">
                            <v-list-item-icon>
                                <v-icon>mdi-power</v-icon>
                            </v-list-item-icon>
                            <v-list-item-title >Logout</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </template>
        </v-app-bar>
        

    </div>




</template>

<script>
  
    export default {
        components: {
          
        
        },
        data() {
            return {
                img: this.$auth.user().user.img,
                drawer: false,
                items: [
                    { title: 'Profile',link:'/logout' },
                    { title: 'Logout',link:'' },
                ],
            }
        },
        mounted() {

        },
        methods:{
            onClickBtn(){
                this.drawer = !this.drawer;
                this.$emit("drawer",this.drawer)
            }
        },
    }
</script>

<style scoped>
    


</style>