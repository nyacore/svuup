export default {
    state: () => ({
        tags: []
    }),
    getters: {
        TAGS(state) {
            return state.tags;
        }
    },
    mutations: {
        SET_TAGS(state, tags) {
            state.tags = tags;
        }
    },
    actions: {
        FETCH_TAGS({ commit }) {
            commit('SET_TAGS', [
                'Тег 1', 'Тег 2'
            ]);
        }
    }
}
