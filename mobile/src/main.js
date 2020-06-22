import Vue from 'vue'
import router from "./router";
import App from './App.vue'
require('./assets/scripts/lib-flexible-min.js') 
Vue.config.productionTip = false


new Vue({
	router:router,
  render: h => h(App),
}).$mount('#app')
