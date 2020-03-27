<template>
    <div>
        
        <div v-if="has_error && !success">
            <v-alert type="error" dense>
                        {{message}}
            </v-alert>
        </div>
        <div v-else-if="!has_error && success">
            <v-alert type="success" dense>
                <ul>
                    {{message}}
                </ul>
            </v-alert>
        </div>
        <v-card>
            <sr-bread-crumbs  :breadcrumbs="breadcrumbs"></sr-bread-crumbs>
            <v-card-title>
                New Image    
                <v-spacer></v-spacer>
           
            </v-card-title>
            <v-form  ref="myForm" class="new-image-form"  v-model="valid">
                <v-file-input
                    v-model="form.picture"
                    ref="home_picture"
                    name="img"
                    accept="image/gif"
                    placeholder="Picture"
                    prepend-icon="mdi-camera"
                    label="Image"
                ></v-file-input>

                <v-combobox
                    v-model="form.tags"
                    hide-selected
                    label="Tags"
                    multiple
                    small-chips
                    class="mb-12"
            >
            </v-combobox>

                <v-card-actions>

                <v-btn
                        :disabled="!valid"
                        color="primary"
                        class="mr-4"
                        @click="store"
                        :loading="saving"
                >
                    Save
                </v-btn>
            


            </v-card-actions>
            </v-form>
                
            </v-data-table>
        </v-card>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                breadcrumbs: [
                    {
                        text: 'Home',
                        disabled: false,
                        to: '/Admin',
                    },                
                ],   
                form:{
                    picture:null,
                    tags:[]
                },
                valid:true,
                saving: false,
                success: false,
                has_error: false,
                message: '',
    
            }
        },
        methods: {
            
            store() {
                var self = this;
                try
                {
                    this.saving = true;
                
                    if(!this.form.picture  )
                    {
                        throw 'Picture is required';
                    }
            
                    var _validFileExtensions = ["gif"];
                    var extension = this.form.picture.name.substr(this.form.picture.name.lastIndexOf('.') + 1).toLowerCase();
                    
                    if (_validFileExtensions.indexOf(extension) === -1) 
                    {
                        throw 'Invalid file Format. Only ' + '.gif' + ' are allowed.';
                    }
                    var tags = '';
                    for( var i = 0 ; i < this.form.tags.length ; i++)
                    {
                        if(i>0)
                        {
                            tags += ',';
                      
                        }
                        tags += this.form.tags[i];    
                    }
                  
                    let formData = new FormData();                   
                    formData.append('picture', this.form.picture);  
                    formData.append('tags', tags);               
                    this.axios.post('picture/upload-image', formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            },
                        }
                    ).then((response) => {
                        
                        var self=this;
                        setTimeout(function(){
                            self.success = true;
                            self.message = response.data.message;
                            setTimeout(function(){
                                self.$router.push('/Admin');
                            },1000);
                            
                        }, 1000);
                    }).catch((err) => {
                        this.has_error = true;
                        this.saving = false;
                        this.message = err.message;
                        this.errors = [err.message];
                    });
                }
                catch(err)
                {
                    
                    self.saving = false;
                    self.message = err;
                    self.has_error = true;
                    var self = this;
                    setTimeout(function(){
                        self.errors=[];
                        self.has_error = false;
                    },2000);
                }
            },
            
        },
        mounted() {
            setTimeout(function () {
                $('#spinner').fadeOut('slow')
            }, 3000)
        },
        created() {
        
            $('#spinner').fadeIn(100)
        }
    }
</script>