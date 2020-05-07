export default {
    state: () => ({
        scenarios: []
    }),
    getters: {
        SCENARIOS(state) {
            return state.scenarios;
        }
    },
    mutations: {
        SET_SCENARIOS(state, scenarios) {
            state.scenarios = scenarios;
        }
    },
    actions: {
        FETCH_SCENARIOS({ commit }) {
            commit('SET_SCENARIOS', [
                'Стандартный', 'Обзвон роботом'
            ]);
        }
    }
}
