export default {
    state: () => ({
        specialities: []
    }),
    getters: {
        SPECIALITIES(state) {
            return state.specialities;
        }
    },
    mutations: {
        SET_SPECIALITIES(state, specialities) {
            state.specialities = specialities;
        }
    },
    actions: {
        async FETCH_SPECIALITIES({ commit }, page = 1) {
            const specialities = await axios.get(`/api/specialities?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_SPECIALITIES', specialities.data);
        },
        async FETCH_SPECIALITY_BY_ID({ commit }, id) {
            const speciality = await axios.get(`/api/specialities/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_SPECIALITIES', [speciality.data]);
        },
        async STORE_SPECIALITY({ commit }, data) {
            const response = await axios.post(`/api/specialities`, data, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        },
        async DELETE_SPECIALITY({ commit }, id) {
            const response = await axios.delete(`/api/specialities/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        },
        async SYNC_DISCIPLINES({ commit }, data) {
            const response = await axios.post(`/api/specialities/${data.id}/disciplines`, data.formData, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        }
    }
}
