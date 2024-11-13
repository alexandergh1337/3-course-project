import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Contacts from '../pages/Contacts.vue'
import About from '../pages/About.vue'
import Catalog from '../pages/Catalog.vue'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/contacts',
        name: 'Contacts',
        component: Contacts
    },
    {
        path: '/about',
        name: 'About',
        component: About
    },
    {
        path: '/catalog',
        name: 'Catalog',
        component: Catalog
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
