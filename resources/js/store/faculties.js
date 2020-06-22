export default {
    state: () => ({
        faculties: []
    }),
    getters: {
        FACULTIES(state) {
            return state.faculties;
        }
    },
    mutations: {
        SET_FACULTIES(state, faculties) {
            state.faculties = faculties;
        }
    },
    actions: {
        async FETCH_FACULTIES({ commit }, page = 1) {
            const faculties = await axios.get(`/api/faculties?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            console.log(faculties);

            faculties.data.data = faculties.data.data.map(f => {
                f.specialities = f.specialities.map(s => {
                    s.selectedDisciplines = s.disciplines.map(d => d.id);

                    return s;
                })

                return f;
            })

            console.log(faculties);


            commit('SET_FACULTIES', faculties.data);
        },
        async FETCH_FACULTY_BY_ID({ commit }, id) {
            const faculty = await axios.get(`/api/faculties/${id}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_FACULTIES', [faculty.data]);
        },
        async STORE_FACULTY({ commit }, data) {
            const response = await axios.post(`/api/faculties`, data, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        }
    }
}
