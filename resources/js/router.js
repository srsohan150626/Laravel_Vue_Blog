import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)
import firstPage from './components/pages/myFirstVuePage'
import newPage from './components/pages/newPage'
import hooks from './components/pages/basic/hooks'
import methods from './components/pages/basic/methods.vue'

//project pages
import home from './components/pages/home.vue'
import tags from './admin/pages/tags.vue' 
import category from './admin/pages/category.vue'

//vuex 
import usecomp from './vuex/usecomp'

const routes = [
    //projects route 
    {
        path: '/',
        component: home
    },
    {
        path: '/tags',
        component: tags
    },
    {
        path: '/category',
        component: category
    },
    {
        path: '/testvuex',
        component: usecomp
    },








    //basic route
    {
        path: '/my-new-vue-route',
        component: firstPage
    },
    {
        path: '/new-route',
        component: newPage
    },
    {
        path: '/hooks',
        component: hooks
    },
    {
        path: '/methods',
        component: methods
    }
]

export default new Router({
    mode: 'history',
    routes
})