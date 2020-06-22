import Vue from 'vue'
import Router from 'vue-router'
import Home from "@/pages/Index.vue"
import List from "@/pages/List.vue"
import Score from "@/pages/Score.vue"
import Loading from "@/pages/Loading.vue"
import Login from "@/pages/Login.vue"
import Statistics from "@/pages/Statistics.vue"
import Result from "@/pages/Result.vue"
import Top from "@/pages/Top.vue"
import page404 from '@/pages/404'

const routes = [
  { path: '/',name: 'home',component: Home },
  { path: '/loading',name: 'loading', component: Loading },
  { path: '/login',name: 'login', component: Login },
  { path: '/score',name: 'score', component: Score },
  { path: '/statistics',name: 'statistics', component: Statistics },
  { path: '/result',name: 'result', component: Result },
  { path: '/top',name: 'top', component: Top },
  { path: '/programs',name: 'programs', component: List },
  { path: '*',name: '404', component: page404 }
]
Vue.use(Router)

const router = new Router({
  mode:'history',
  routes
})

export default router
