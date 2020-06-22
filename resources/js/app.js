
require('./bootstrap');


window.Vue = require('vue');

// import 'vuetify/dist/vuetify.min.css'

// import Vuetify from 'vuetify';
// Vue.use(Vuetify);

import vuetify from '@/plugins/vuetify'

import router from './router';
import store from './store/index';

// axios.interceptors.request.use(config => {
// 	config.headers['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
// 	config.headers['X-Requested-With'] = 'XMLHttpRequest';

// 	if (jwtToken.getToken()) {
// 		config.headers['Authorization'] = 'Bearer ' + jwtToken.getToken();
// 	}

// 	return config;
// }, error => {
// 	return Promise.reject(error);
// });

axios.interceptors.response.use(response => {
	return response;
}, error => {

    if (error.response.status == 401){
        window.location = "/login";
    }else if (error.response.status == 423){
        window.location = "/users/password";
    }else if (error.response.status == 419){
        window.location = "/login";
    }
    else if (error.response.status == 503){
        window.location = "/";
    }
    //let errorResponseData = error.response.data;
    //console.log(error.response.status);
    //store.dispatch('unsetAuthUser')
    //router.push({name: 'home'});

	//const errors = ["token_invalid", "token_expired", "token_not_provided"];

	// if (errorResponseData.error && errors.includes(errorResponseData.error)) {
	// 	store.dispatch('unsetAuthUser')
	// 		.then(() => {
	// 			jwtToken.removeToken();
	// 			router.push({name: 'login'});
	// 		});
	// }

	return Promise.reject(error);
});


/*********************************
/* VuetifyToast
**********************************/
import Vuetify, { VSnackbar } from 'vuetify/lib'
import VuetifyToast from 'vuetify-toast-snackbar'

Vue.use(Vuetify, {
    components: {
    VSnackbar
    }
    })

// const opts = {x: 'center--text',
//         y: 'top',
//         color: 'info',
//         icon: 'info',
//         timeout: 3000,
//         dismissable: true,
//         autoHeight: false,
//         multiLine: false,
//         vertical: false,
//         property: '$toast' }; // your options
// const vueObj = new Vuetify(opts);

// export default vueObj;

Vue.use(VuetifyToast, { $vuetify: vuetify.framework,
    x: 'center',
    y: 'top', // default
    color: 'info', // default
    icon: '', iconColor: '', // default
    classes: [ 'body-2' ], timeout: 4000, // default
    dismissable: true, // default
    multiLine: false, // default
    vertical: false, // default
    queueable: true, // default
    showClose: false, // default
    closeText: '', // default
    closeColor: '', // default
    shorts: { custom: { color: 'purple' } },
    property: '$toast' // default
 });

    // Vue.use(VuetifyToast, { $vuetify: vueObj.framework });

    // Vue.use(VuetifyToast, {
    // 	x: 'center--text', // default
    // 	y: 'top',
    // 	color: 'info', // default
    // 	icon: 'info',
    // 	timeout: 3000, // default
    // 	dismissable: true, // default
    // 	autoHeight: false, // default
    // 	multiLine: false, // default
    // 	vertical: false, // default
    // 	shorts: {
    // 		custom: {
    // 			color: 'purple'
    // 		}
    // 	},
    // 	property: '$toast' // default
    // })

/*************************
 * VeeValidate
 *************************/
import VeeValidate from 'vee-validate';
import VueValidationEs from 'vee-validate/dist/locale/es';
const config = {
	locale: 'es',
  	dictionary: {
	  	es: VueValidationEs
  	}
};
Vue.use(VeeValidate, config);

/***************************
 *  formateo números
 *******************************/
import Vue2Filters from 'vue2-filters'

Vue.use(Vue2Filters)
/***************************** */


Vue.component('form-login', require('./components/auth/FormLogin.vue').default);
Vue.component('mail-login', require('./components/auth/MailLogin.vue').default);
Vue.component('reset-login', require('./components/auth/ResetLogin.vue').default);


const app = new Vue({
    el: '#app',
    vuetify,
    router,
    store
});
