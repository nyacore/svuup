import Vuex from 'vuex';

import user from './user';
import users from './users';
import disciplines from './disciplines';
import faculties from './faculties';
import specialities from './specialities';
import roles from './roles';
import groups from './groups';
import events from './events';
import marks from './marks';
import threads from './threads';
import messages from './messages';

export default new Vuex.Store({
    modules: {
        user,
        users,
        disciplines,
        faculties,
        specialities,
        roles,
        groups,
        events,
        marks,
        threads,
        messages
    }
})
