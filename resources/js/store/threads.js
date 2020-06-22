export default {
    state: () => ({
        threads: { data: [] }
    }),
    getters: {
        THREADS(state) {
            return state.threads;
        }
    },
    mutations: {
        SET_THREADS(state, threads) {
            state.threads = threads;
        }
    },
    actions: {
        async FETCH_THREADS({ commit }, page = 1) {
            const threads = await axios.get(`/api/threads?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_THREADS', threads.data);
        },
        async FETCH_THREAD({ commit }, id) {
            const thread = await axios.get(`/api/threads/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_THREADS', { data: [thread.data] });
        },
        async STORE_THREAD({ commit }, data) {
            const response = await axios.post(`/api/threads`, data, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        }
    }
}
