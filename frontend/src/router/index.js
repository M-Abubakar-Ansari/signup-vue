import { createRouter, createWebHistory } from 'vue-router'

// Import your page components
import Home from '../Home.vue'
import Signup from '../Signup.vue'
import Dashboard from '../Dashboard.vue'

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/signup', name: 'Signup', component: Signup },
  { path: '/dashboard', name: 'Dashboard', component: Dashboard }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
