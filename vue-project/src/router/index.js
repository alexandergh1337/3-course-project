import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Contacts from '../pages/Contacts.vue'
import About from '../pages/About.vue'
import Catalog from '../pages/Catalog.vue'
import Terms from '../pages/Terms.vue'
import Privacy from '../pages/Privacy.vue'

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
    },
    {
        path: '/terms',
        name: 'Terms',
        component: Terms
    },
    {
        path: '/privacy',
        name: 'Privacy',
        component: Privacy
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
