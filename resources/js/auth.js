 import bearer from '@websanova/vue-auth/drivers/auth/bearer.js'
 import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
 import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'

 /**
  * Authentication configuration, some of the options can be override in method calls
  */
 const config = {
     authRedirect: '/Admin/login',
     auth: bearer,
     http: axios,
     router: router,
     tokenDefaultName: 'token',
     tokenStore: ['localStorage'],
     //rolesVar: 'roles',

     // API endpoints used in Vue Auth.
     registerData: {
         url: 'auth/register',
         method: 'POST',
         redirect: '/Admin'
     },
     loginData: {
         url: 'auth/login',
         method: 'POST',
         redirect: '/Admin',
         fetchUser: true
     },
     logoutData: {
         url: 'auth/logout',
         method: 'POST',
         redirect: '/Admin/login',
         makeRequest: true
     },
     fetchData: {
         url: 'auth/user',
         method: 'GET',
         enabled: true
     },
     refreshData: {
         url: 'auth/refresh',
         method: 'GET',
         enabled: true,
         interval: 20
     }
 };
 export default config