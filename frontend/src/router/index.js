import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/Home'
// import VoteIndex from '@/pages/vote/VoteIndex'
import VoteList from '@/pages/vote/VoteList'
import VoteDetail from '@/pages/vote/VoteDetail'
import Start from '@/pages/Start'
import Campaign from '@/pages/Campaign'
import Login from '@/pages/Login'
import UpdateCampaign from '@/pages/UpdateCampaign'

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
      path: '/program',
      name: 'start',
      component: Start
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/campaign',
      name: 'campaign',
      component: Campaign
    },
    {
      path: '/programs',
      name: 'vote-list',
      component: VoteList
    },
    {
      path: '/program/:id',
      name: 'vote-program',
      component: VoteDetail
    },
    {
      path: '/campaign',
      name: 'campaign',
      component: UpdateCampaign
    }
    // {
    //   path: '/vote',
    //   name: 'vote',
    //   component: Submit
    // },
    // {
    //   path: '/programs',
    //   name: 'programs',
    //   component: Programs
    // },
    // {
    //   path: '/program/statistics',
    //   name: 'statistics',
    //   component: Statistics
    // },
    // {
    //   path: '/program/:id',
    //   name: 'program',
    //   component: Score
    // }
  ]
})
