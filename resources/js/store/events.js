export default {
    state: () => ({
        events: []
    }),
    getters: {
        EVENTS(state) {
            return state.events;
        }
    },
    mutations: {
        SET_EVENTS(state, events) {
            state.events = events;
        }
    },
    actions: {
        async FETCH_EVENTS({ commit }, page = 1) {
            const events = await axios.get(`/api/events?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_EVENTS', events.data);
        },
        async FETCH_EVENT({ commit }, id) {
            const event = await axios.get(`/api/events/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_EVENTS', [event.data]);
        },
        async STORE_EVENT({ commit }, data) {
            const response = await axios.post(`/api/events`, data, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        }
    }
}
