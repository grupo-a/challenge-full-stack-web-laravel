import Vue from 'vue'
import VueRouter from 'vue-router'
import Students from '../components/Students.vue'
import Dashboard from '../components/Dashboard.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/students',
    name: 'students',
    component: Students
  },

  {
    path: '/',
    name: 'dashboard',
    component: Dashboard
  }
]

const router = new VueRouter({
  routes,
  mode: 'history'
})

export default router