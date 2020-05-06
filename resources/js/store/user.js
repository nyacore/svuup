export default {
    state: () => ({
        isLoggedIn: !!localStorage.getItem('api_token'),
        user: {

        }
    }),

    mutations: {
        LOGIN(state, user) {
            state.isLoggedIn = true;

            state.user = user;
        },
        LOGOUT(state) {
            state.isLoggedIn = false;
        },
        SET_USER(state, user) {
            state.user = user;
        }
    },

    actions: {
        FETCH_USER({ commit }) {
            /**
             * Fetch user data from API
             *
             * const user = window.axios...
             */

            const user = {
                name: 'gasaichan'
            }

            this.commit('SET_USER', user);
        },
        async LOGIN_USER({ commit }, formData) {
            const response = await window.axios.post('/api/auth/login', formData);
            console.log(response);
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
