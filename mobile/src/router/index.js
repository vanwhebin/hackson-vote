import Vue from 'vue'
import Router from 'vue-router'
import Hackthon from "@/pages/Index.vue"
import List from "@/pages/List.vue"
import Result from "@/pages/Result.vue"
import page404 from '@/pages/404'
import Login from '@/pages/Login'

const routes = [
  { path: '/',name: 'home',component: Hackthon },
  { path: '/result',name: 'result', component: Result },
  { path: '/programs',name: 'programs', component: List },
  { path: '/login',name: 'login', component: Login },
  { path: '*',name: '404', component: page404 }
]
Vue.use(Router)

const router = new Router({
  mode:'history',
  routes
})

export default router
