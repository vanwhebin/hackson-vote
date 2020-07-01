import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/Home'
import Start from '@/pages/Start'
import Campaign from '@/pages/Campaign'
import Program from '@/pages/Program'
import Login from '@/pages/Login'
import Result from '@/pages/Result'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/start',
      name: 'start',
      component: Start
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/result',
      name: 'result',
      component: Result
    },
    {
      path: '/campaign',
      name: 'campaign',
      component: Campaign
    },
    {
      path: '/program',
      name: 'program',
      component: Program
    }
  ]
})
