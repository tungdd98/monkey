import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import store from '@/store'

import Dashboard from '@/pages/admin/Dashboard'
import newsfeed from '@/pages/admin/newsfeed/router'
import Login from '@/pages/admin/Login'
import Register from '@/pages/admin/Register'

import Home from '@/pages/home/Home'
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/admin',
    component: Dashboard,
    children: [
      newsfeed
    ],
    meta: { requiresAuth: true }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: { unAuthen: true }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: { unAuthen: true }
  },
]
const router = new VueRouter({
  routes,
  mode: 'history'
})
router.beforeEach((to, from, next) => {
  store.dispatch('auth/checkUserLogin').then(res => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (!res.flag) {
        next({
          path: '/login',
          query: { redirect: to.fullPath }
        })
      } else {
        next()
      }
    } else if (to.matched.some(record => record.meta.unAuthen)) {
      if(!res.flag) {
        next()
      } else {
        next({
          path: '/admin',
          query: { redirect: to.fullPath }
        })
      }
    } else {
      next()
    }
  })
})
export default router