// Импорт функций создания экземпляра Vue-роутера и создания истории.
import {
    createRouter,
    createWebHistory,
    createWebHashHistory,

} from 'vue-router';

// Импорт компонентов (страниц сайта).
const Main = () => import('./components/pages/Main.vue');

// Роуты (страницы сайта).
const routes = [
    {
        path: '/',
        name: 'Main',
        component: Main
    }
];

// Создание экземпляра Vue-роутера.
const router = createRouter({
    routes: routes,
    history: createWebHistory()
});

// Экспорт экземпляра Vue-роутера.
export default router;
