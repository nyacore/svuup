import Users from '../components/admin/Users';
import Faculties from '../components/admin/Faculties';
import Disciplines from '../components/admin/Disciplines';
import Groups from '../components/admin/Groups';

export default [
    {
        path: '/admin/users',
        component: Users,
        name: 'admin.users'
    },
    {
        path: '/admin/faculties',
        component: Faculties,
        name: 'admin.faculties'
    },
    {
        path: '/admin/disciplines',
        component: Disciplines,
        name: 'admin.disciplines'
    },
    {
        path: '/admin/groups',
        component: Groups,
        name: 'admin.groups'
    }
]
