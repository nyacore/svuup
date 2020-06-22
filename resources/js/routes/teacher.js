import Disciplines from '../components/teacher/Disciplines';
import Grades from '../components/teacher/Grades';

export default [
    {
        path: '/teacher/disciplines',
        name: 'teacher.disciplines',
        component: Disciplines
    },
    {
        path: '/teacher/disciplines/:discipline',
        name: 'teacher.disciplines.view',
        component: Grades
    }
];
