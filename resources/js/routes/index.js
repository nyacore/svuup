import VueRouter from 'vue-router';

import Login from '../components/auth/Login';
import Leads from '../components/Leads';
import CreateLead from '../components/CreateLead';
import ShowLead from '../components/ShowLead';

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
            path: '/admin/leads/create',
            name: 'leads.create',
            component: CreateLead
        },
        {
            path: '/admin/leads/:id',
            name: 'leads.show',
            component: ShowLead
        },
        {
            path: '/login',
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
