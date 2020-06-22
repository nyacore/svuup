export default {
    state: () => ({
        groups: []
    }),
    getters: {
        GROUPS(state) {
            return state.groups;
        }
    },
    mutations: {
        SET_GROUPS(state, groups) {
            state.groups = groups;
        }
    },
    actions: {
        async FETCH_GROUPS({ commit }, page = 1) {
            const groups = await axios.get(`/api/groups?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_GROUPS', groups.data);
        },
        async FETCH_GROUP_BY_ID({ commit }, id) {
            const group = await axios.get(`/api/groups/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_GROUPS', [group.data]);
        },
        async STORE_GROUP({ commit }, data) {
            const response = await axios.post(`/api/groups`, data, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        }
    }
}
