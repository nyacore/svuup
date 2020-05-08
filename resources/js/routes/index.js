import VueRouter from 'vue-router';

import Login from '../components/auth/Login';
import Leads from '../components/Leads';

const router = new VueRouter({
    mode: 'history',

    routes: [
        {
            path: '/',
            redirect: '/admin'
        },
        {
            path: '/admin',
            name: 'home',
            component: Leads,
        },
        {
            path: '/admin/leads',
            name: 'leads',
            component: Leads,
        },
        {
            path: '/admin/login',
            name: 'login',
            component: Login
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (!window.localStorage.getItem('api_token') && to.name !== 'login') {
        next({ name: 'login' });
    } else {
        next();
    }
});

export default router;
