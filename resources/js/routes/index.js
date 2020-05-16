import VueRouter from 'vue-router';

import Login from '../components/auth/Login';
import Leads from '../components/leads/Leads';
import CreateLead from '../components/leads/CreateLead';
import ShowLead from '../components/leads/ShowLead';
import Contacts from '../components/Contacts';
import Tasks from '../components/tasks/Tasks';

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
            path: '/admin/contacts',
            name: 'contacts',
            component: Contacts
        },
        {
            path: '/admin/tasks',
            name: 'tasks',
            component: Tasks
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
