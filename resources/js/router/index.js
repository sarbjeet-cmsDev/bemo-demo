import { createRouter, createWebHistory } from 'vue-router'

import Home from '../views/Home.vue'
import Tickets from '../views/Ticket/Index.vue'
import Dashboard from '../views/Dashboard/Index.vue'
import Ticket from '../views/Ticket/View.vue'

const routes = [
  { path: '/', name: 'Home', component: Home },
  { path: '/dashboard', name: 'Dashboard', component: Dashboard },
  { path: '/tickets', name: 'Tickets', component: Tickets },
  { path: '/ticket/:id', name: 'Ticket', component: Ticket }
]

export default createRouter({
  history: createWebHistory(),
  routes,
})