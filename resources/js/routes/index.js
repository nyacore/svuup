import VueRouter from 'vue-router';

import admin from './admin';
import teacher from './teacher';

import Login from '../components/auth/Login';
import Learning from '../components/Learning';
import Messages from '../components/Messages';
import Thread from '../components/Thread';
import Info from '../components/Info';
import Events from '../components/Events';


const router = new VueRouter({
    mode: 'history',

    routes: [
        ...admin,
        ...teacher,
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/learning',
            component: Learning,
            children: [{
                path: '/',
                name: 'learning',
                component: Info
            }, {
                path: '/events/:discipline',
                name: 'events',
                component: Events
            }]
        },
        {
            path: '/messages',
            name: 'messages',
            component: Messages
        },
        {
            path: '/messages/:thread',
            name: 'messages.thread',
            component: Thread
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
