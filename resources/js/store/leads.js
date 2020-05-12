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
        async FETCH_LEADS({ commit }, page = 1) {
            const leads = await axios.get(`/api/admin/leads?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_LEADS', leads.data);
        },
        async FETCH_LEAD({ commit }, id) {
            const lead = await axios.get(`/api/admin/leads/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_LEADS', [lead.data]);
        },
        async STORE_LEAD({ commit }, data) {
            const response = await axios.post(`/api/admin/leads`, data, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        }
    }
}
