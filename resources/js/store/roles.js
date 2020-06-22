export default {
    state: () => ({
        roles: []
    }),
    getters: {
        ROLES(state) {
            return state.roles;
        }
    },
    mutations: {
        SET_ROLES(state, roles) {
            state.roles = roles;
        }
    },
    actions: {
        async FETCH_ROLES({ commit }, page = 1) {
            const roles = await axios.get(`/api/roles?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_ROLES', roles.data);
        },
        async FETCH_ROLE_BY_ID({ commit }, id) {
            const role = await axios.get(`/api/roles/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_ROLES', [role.data]);
        }
    }
}
