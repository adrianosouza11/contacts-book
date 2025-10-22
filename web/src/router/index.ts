import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        redirect: '/contacts'
    },
    {
        path: '/contacts',
        name: 'ContactListPage',
        component: () => import('@/pages/ContactListPage.vue'),
    },
    {
        path: '/contacts/create',
        name: 'ContactCreatePage',
        component: () => import('@/pages/ContactPage.vue'),
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFoundPage',
        component: () => import('@/pages/NotFoundPage.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;