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
        component: () => import('@/pages/ContactCreatePage.vue'),
    },
    {
        path: '/contacts/edit/:id',
        name: 'ContactEditPage',
        component: () => import('@/pages/ContactEditPage.vue'),
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