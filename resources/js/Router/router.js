import Vue from 'vue'
import VueRouter from 'vue-router'

//################### Admin Panel #############################
import Admin from '../admin/index'
import Login from '../auth/login'
import SearchHistory from '../admin/searchHistory'
import NewImage from '../admin/newImage'



import notfound from '../components/404'

//################### End of Admin Panel #############################



Vue.use(VueRouter);

const routes = [
   
 
   
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: {
            auth: false,
            allow: true,
            title: 'Login'
        }
    },
    {
        path: '/',
        component: Admin,
        name:'home',
        meta: {
            auth: true,
            allow: true,
            title: 'home'
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