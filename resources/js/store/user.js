export default {
    state: () => ({
        isLoggedIn: !!localStorage.getItem('api_token'),
        user: {}
    }),

    mutations: {
        LOGIN(state) {
            state.isLoggedIn = true;
        },
        LOGOUT(state) {
            window.localStorage.removeItem('api_token');
            state.isLoggedIn = false;
        },
        SET_USER(state, user) {
            state.user = user;
        }
    },

    actions: {
        FETCH_USER({ commit }) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await axios.post('/api/auth/me', '', {
                        headers: {
                            Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                        }
                    });

                    commit('SET_USER', response.data);

                    resolve();
                } catch (e) {
                    commit('LOGOUT');

                    reject(e);
                }
            });
        },
        async LOGIN_USER({ commit }, data) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await window.axios.post('/api/auth/login', data);

                    window.localStorage.setItem('api_token', response.data.access_token);

                    commit('LOGIN');

                    resolve();
                } catch (e) {
                    reject(e);
                }
            });
        }
    },

    getters: {
        LOGGED_IN(state) {
            return state.isLoggedIn
        },
        USER(state) {
            return state.user;
        }
    }
}
