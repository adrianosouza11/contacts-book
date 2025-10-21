import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        redirect: '/main'
    },
    {
        path: '/main',
        name: 'MainPage',
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