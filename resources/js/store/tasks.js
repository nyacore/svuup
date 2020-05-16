export default {
    state: () => ({
        tasks: []
    }),
    getters: {
        TASKS(state) {
            return state.tasks
        }
    },
    mutations: {
        SET_TASKS(state, tasks) {
            state.tasks = tasks;
        }
    },
    actions: {
        async FETCH_TASKS({ commit }, page = 1) {
            const tasks = await axios.get(`/api/admin/tasks?page=${page}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_TASKS', tasks.data);
        },

        async FETCH_TASKS_BY_LEAD({ commit }, leadId, page = 1) {
            const tasks = await axios.get(`/api/admin/leads/${leadId}/tasks`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });

            commit('SET_TASKS', tasks.data);
        },

        async DELETE_TASK({ commit }, taskId) {
            await axios.delete(`/api/admin/tasks/${taskId}`, {
                headers: {
                    Authorization: `Bearer ${window.localStorage.getItem('api_token')}`
                }
            });
        }
    }
}
