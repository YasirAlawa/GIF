<template>
    <v-app>
        <div>
            <div v-if="message">
                <v-alert type="success" dense>
                    <ul>
                        {{message}}
                    </ul>
                </v-alert>
            </div>
            <v-card class="search_box">
            <v-card-title>
        
                <v-combobox
                    v-model="search"
                    hide-selected
                    append-icon
                    deletable-chips
                    chips
                    label="Search By Keywords"
                    multiple
                    small-chips
                    class=" tag-input"
                > </v-combobox>
                </v-card-title>
            </v-card>
            <v-row justify="space-around" class="images">
                <v-col cols="4" v-for="(image, i) in images">
                    <div class="subheading pt-4">{{image.name}}</div>
                    <v-img :src="image.image_path" aspect-ratio="2" @click ="clickImage(i)"></v-img>
                </v-col>               
            </v-row>
            <v-row justify="space-around"  class="text-center">
                 <v-col cols="12" class="text-center" >                   
                    <v-btn v-if="(showLoadMore)" aspect-ratio="2" @click ="loadMore()" :loading="loadingMore">Load More</v-btn>
                </v-col>
            </v-row>
        </div>
        <v-dialog v-model="imageDialog" persistent max-width="600px">

            <v-card>
                <v-card-title>
                    <span class="headline">Images</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-carousel
                            cycle
                            height="400"
                            hide-delimiter-background
                            show-arrows-on-hover
                            v-model="currentImage"
                            >
                            <v-carousel-item
                            v-for="(image, i) in images"
                            :key="i"
                            >
                                <div class="subheading pt-4">{{image.name}}</div>
                                <v-img :src="image.image_path" aspect-ratio="2" ></v-img>
                            </v-carousel-item>
                        </v-carousel>
                    </v-container>
                    
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="imageDialog = false">Close</v-btn>               
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>

</template>


<script>


    export default {
        
         data() {
             return {
                 search:'',
                 images:[],
                 loadingMore:false,
                 message:'',
                 currentImage: 0,
                 currentPage: 1,
                 showLoadMore:false,
                 imageDialog:false,                           
             };
         },
         watch: {
          
            search() {
                this.getItems(1);
                
            }
        },
        methods:{
            clickImage(index)
            {
                this.currentImage = index;
                this.imageDialog = true;
            },
            loadMore()
            {
                this.getItems(this.currentPage+1);
            },

            getItems(currentPage) {
                this.currentPage=currentPage;
                var ar = this.search;
                if(ar.length<=0)
                    return ;
                var search_query = '';
                for(let i=0;i<ar.length;i++)
                {
                    if(i>0)
                        search_query +=',';
                    search_query += ar[i];
                }
                if(currentPage==1)
                {
                        this.images =[];                        
                }
               
                this.showLoadMore = true;
                this.loadingMore = true;
                this.axios.get('dashboard/search/'+search_query+'/'+this.currentPage).then((res) => {
                    if (res.data.status == 'error') {
                        this.loadingMore = false;
                        this.has_error = true;
                        this.message = res.data.message;
                        this.loading = false;
                        this.showLoadMore = false;
                    } else {
                        this.loadingMore = false;
                        if(this.currentPage==1)
                            this.images = res.data.data.images;
                        else
                        {
                            this.images =  this.images.concat(res.data.data.images);
                            
                        }

                    }
                })
            },
        }
    }
</script>
<style scoped>
    .search_box
    {
        width:50%;
        margin:auto;
    }
    .tag-input span.v-chip {
        background-color: #1976d2;
        color: #fff;
        font-size:1em;
        padding-left:7px;
    }
    .tag-input span.chip {
        background-color: #1976d2;
        color: #fff;
        font-size: 1em;
    }
    .tag-input span.v-chip::before {
        content: "label";
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 20px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-feature-settings: 'liga';
        -webkit-font-smoothing: antialiased;
    }
</style>
