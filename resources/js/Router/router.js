import Vue from 'vue'
import VueRouter from 'vue-router'

//################### Admin Panel #############################
import Admin from '../admin/index'
import Login from '../auth/login'
import SearchHistory from '../admin/searchHistory'
import NewImage from '../admin/newImage'



import notfound from '../components/404'

//################### End of Admin Panel #############################

//################### Website Pages #############################
import Home from '../home/index'



//################### End of Website Pages #############################

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        props:true,
        meta: {
            allow: true,
            title: 'Home',
        }
    },
 
   
    {
        path: '/Admin/login',
        name: 'Login',
        component: Login,
        meta: {
            auth: false,
            allow: true,
            title: 'Login'
        }
    },
    {
        path: '/Admin',
        component: Admin,
        name:'Admin',
        meta: {
            auth: true,
            allow: true,
            title: 'Admin'
        },
        children: [
            {
                path: 'history',
                component: SearchHistory
            },  
            {
                path: 'image',
                component: NewImage
            },          
        ]

    },

    {path: "*", component: notfound}

];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
});

export default router