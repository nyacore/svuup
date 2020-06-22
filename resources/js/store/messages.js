export default {
    state: () => ({
        messages: { data: [] }
    }),
    getters: {
        MESSAGES(state) {
            return state.messages;
        }
    },
    mutations: {
        SET_MESSAGES(state, messages) {
            state.messages = messages;
        }
    },
    actions: {
        async FETCH_MESSAGES({ commit }, page = 1) {
            const messages = await axios.get(`/api/messages?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_MESSAGES', messages.data);
        },
        async FETCH_MESSAGE({ commit }, id) {
            const message = await axios.get(`/api/messages/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_MESSAGES', { data: [message.data] });
        },
        async STORE_MESSAGE({ commit }, data) {
            const response = await axios.post(`/api/messages`, data, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        }
    }
}
