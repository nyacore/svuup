export default {
    state: () => ({
        leads: []
    }),
    getters: {
        LEADS(state) {
            return state.leads;
        }
    },
    mutations: {
        SET_LEADS(state, leads) {
            state.leads = leads;
        }
    },
    actions: {
        async FETCH_LEADS({ commit }) {
            const leads = await axios.get('/api/admin/leads', {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_LEADS', leads.data);
        }
    }
}
