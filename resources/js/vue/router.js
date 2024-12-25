// Импорт функций создания экземпляра Vue-роутера и создания истории.

import {
    createRouter,
    createWebHistory,
    createWebHashHistory,

} from 'vue-router';
import $auth from './global/$auth';

// Импорт компонентов (страниц сайта).
const Applications = () => import('./components/pages/Applications.vue');
const ApplicationShow = () => import('./components/pages/ApplicationShow.vue');
const ApplicationCreate = () => import('./components/pages/ApplicationCreate.vue');
const ApplicationUpdate = () => import('./components/pages/ApplicationUpdate.vue');
const Main = () => import('./components/pages/Main.vue');
const Login = () => import('./components/pages/auth/Login.vue');
const Register = () => import('./components/pages/auth/Register.vue');
const AdminPanel = () => import('./components/pages/auth/admin/AdminPanel.vue');
const ApplicationsAdmin = () => import('./components/pages/auth/admin/partials/ApplicationsAdmin.vue');
const UsersAdmin = () => import('./components/pages/auth/admin/partials/UsersAdmin.vue');

const UserProfile = () => import('./components/pages/auth/user/UserProfile.vue');
const UserProfileUpdate = () => import('./components/pages/auth/user/UserProfileUpdate.vue');


// Добавить роут в массив роутов.

// Добавить роут в массив роутов.

// Роуты (страницы сайта).
const routes = [
    {
        path: '/',
        name: 'Main',
        component: Main
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta: { role: 'guest' }
    },
    {
        path: '/AdminPanel',
        name: 'AdminPanel',
        component: AdminPanel,
        redirect: { name: 'ApplicationsAdmin' },
        meta: { role: 'admin' },
        children: [
            {
                path: 'applications-admin',
                name: 'ApplicationsAdmin',
                component: ApplicationsAdmin,
            },
            {
                path: 'users-admin',
                name: 'UsersAdmin',
                component: UsersAdmin,
            },
        ],
    },
    {
        path: '/UserProfile',
        name: 'UserProfile',
        component: UserProfile,
        meta: { role: 'user' }
    },
    {
        path: '/user/update/:id',
        name: 'UserProfileUpdate',
        component: UserProfileUpdate,
        props: true
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: { role: 'guest' }
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
router.beforeResolve(function (to, from, next) {
    // Проверка, имеет ли роут свойство middleware в объекте meta.
    if (to.meta.role) {
        // Если да, то проверяем, может ли текущий пользователь перейти на этот роут
        // (есть ли у него права).
        if ($auth.user.role === to.meta.role) {
            // Если да, то пускаем пользователя на роут.
            next();
        } else {
            // Если нет, то редиректим на стартовую страницу (общедоступную).
            next({ name: 'Main' });
        }
    } else {
        // Если нет, то пускаем пользователя на роут.
        next();
    }
});

// Экспорт экземпляра Vue-роутера.
export default router;
