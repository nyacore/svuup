export default {
    state: () => ({
        marks: {
            data: [
                {
                    mark: 0
                }
            ]
        }
    }),
    getters: {
        MARKS(state) {
            return state.marks;
        }
    },
    mutations: {
        SET_MARKS(state, marks) {
            state.marks = marks;
        },
        SET_MARK(state, { index, value }) {
            state.marks.data[index].mark = value;
        }
    },
    actions: {
        async FETCH_MARKS({ commit }, page = 1) {
            const marks = await axios.get(`/api/marks?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_MARKS', marks.data);
        },
        async FETCH_MARK({ commit }, id) {
            const mark = await axios.get(`/api/marks/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_MARKS', [mark.data]);
        },
        async STORE_MARK({ commit }, data) {
            const response = await axios.post(`/api/marks`, data, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        },
        async STORE_MARKS({ commit }, data) {
            const formData = new FormData();
            formData.append('marks', JSON.stringify(data));

            const response = await axios.post(`/api/marks`, formData, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        }
    }
}
