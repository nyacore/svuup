export default {
    state: () => ({
        users: []
    }),
    getters: {
        USERS(state) {
            return state.users;
        }
    },
    mutations: {
        SET_USERS(state, users) {
            state.users = users;
        }
    },
    actions: {
        async FETCH_USERS({ commit }, page = 1) {
            const users = await axios.get(`/api/users?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_USERS', users.data);
        },
        async FETCH_USER_BY_ID({ commit }, id) {
            const lead = await axios.get(`/api/users/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_USERS', [lead.data]);
        },
        async STORE_USER({ commit }, data) {
            const response = await axios.post(`/api/users`, data, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        },
        async FETCH_TEACHERS({ commit }) {
            const users = await axios.get(`/api/users?role=teacher`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_USERS', users.data);
        },
        async FETCH_STUDENTS({ commit }) {
            const users = await axios.get(`/api/users?role=student`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_USERS', users.data);
        },

        async ATTACH_STUDENT({ commit }, data) {
            const response = await axios.post(`/api/groups/${data.groupId}/user`, data.data, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            })
        }
    }
}
