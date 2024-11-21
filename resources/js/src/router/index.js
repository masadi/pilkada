import Vue from 'vue'
import VueRouter from 'vue-router'

// Routes
import { canNavigate } from '@/libs/acl/routeProtection'
import { isUserLoggedIn, getUserData, getHomeRouteForLoggedInUser } from '@/auth/utils'
Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [
    {
      path: '/',
      name: 'beranda',
      component: () => import('@/views/pages/Index.vue'),
      meta: {
        layout: 'horizontal',
        resource: 'Web',
        action: 'read',
      },
    },
    {
      path: '/login',
      name: 'auth-login',
      component: () => import('@/views/pages/Login.vue'),
      meta: {
        layout: 'full',
        resource: 'Auth',
        redirectIfLoggedIn: true,
      },
    },
    {
      path: '*',
      redirect: 'error-404',
    },
  ],
})

router.beforeEach((to, _, next) => {
  const isLoggedIn = isUserLoggedIn()
  console.log(to.meta);
  //if (to.meta && to.meta.resource && !canNavigate(to)) {
  if (!canNavigate(to)) {
    // Redirect to login if not logged in
    if (!isLoggedIn) return next({ name: 'auth-login' })
    // If logged in => not authorized
    return next({ name: 'misc-not-authorized' })
  }

  // Redirect if logged in
  if (to.meta.redirectIfLoggedIn && isLoggedIn) {
    return next()
  }

  return next()
})

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})

export default router
