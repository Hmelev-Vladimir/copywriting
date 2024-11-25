// Импорт функций создания экземпляра Vue-роутера и создания истории.
import {
    createRouter,
    createWebHistory,
    createWebHashHistory,

} from 'vue-router';

// Импорт компонентов (страниц сайта).
const Applications = () => import('./components/pages/Applications.vue');
const ApplicationShow = () => import('./components/pages/ApplicationShow.vue');
const ApplicationCreate = () => import('./components/pages/ApplicationCreate.vue');
const ApplicationUpdate = () => import('./components/pages/ApplicationUpdate.vue');
const Main = () => import('./components/pages/Main.vue');

// Роуты (страницы сайта).
const routes = [
    {
        path: '/',
        name: 'Main',
        component: Main
    },
    {
        path: '/applications',
        name: 'Applications',
        component: Applications
    },
    {
        path: '/applications/:id',
        name: 'ApplicationShow',
        component: ApplicationShow,
        props: true
    },
    {
        path: '/applications/update/:id',
        name: 'ApplicationUpdate',
        component: ApplicationUpdate,
        props: true
    },
    {
        path: '/applications/create',
        name: 'ApplicationCreate',
        component: ApplicationCreate,
        props: true
    },
];

// Создание экземпляра Vue-роутера.
const router = createRouter({
    routes: routes,
    history: createWebHistory()
});

// Экспорт экземпляра Vue-роутера.
export default router;
