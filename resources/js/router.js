import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import store from '@/store'

import Admin from '@/views/admin/Base'
import dashboard from '@/views/admin/pages/dashboard/router'
import Login from '@/views/Login'
import Register from '@/views/Register'

import Home from '@/views/home/Base'
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/admin',
    component: Admin,
    children: [
      dashboard
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