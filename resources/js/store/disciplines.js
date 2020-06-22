export default {
    state: () => ({
        disciplines: { data: [{}] }
    }),
    getters: {
        DISCIPLINES(state) {
            return state.disciplines;
        }
    },
    mutations: {
        SET_DISCIPLINES(state, disciplines) {
            state.disciplines = disciplines;
        }
    },
    actions: {
        async FETCH_DISCIPLINES({ commit }, page = 1) {
            const disciplines = await axios.get(`/api/disciplines?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_DISCIPLINES', disciplines.data);
        },
        async FETCH_DISCIPLINE({ commit }, id) {
            const discipline = await axios.get(`/api/disciplines/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_DISCIPLINES', { data: discipline.data });
        },
        async STORE_DISCIPLINE({ commit }, data) {
            const response = await axios.post(`/api/disciplines`, data, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        }
    }
}
