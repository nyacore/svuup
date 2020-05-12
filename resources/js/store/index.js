import Vuex from 'vuex';

import user from './user';
import scenarios from './scenarios';
import tags from './tags';
import leads from './leads';
import tasks from './tasks';

export default new Vuex.Store({
    modules: {
        user,
        scenarios,
        tags,
        leads,
        tasks
    }
})
