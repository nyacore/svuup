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
        FETCH_LEADS({ commit }) {
            commit('SET_LEADS', [
                {
                    name: "Прозвон 1",
                    email: "email@test.com",
                    phone: "+7 (927) 627-10-75"
                },
                {
                    name: "Прозвон 2",
                    email: "email@test.com",
                    phone: "+7 (927) 627-10-75"
                },
                {
                    name: "Прозвон 3",
                    email: "email@test.com",
                    phone: "+7 (927) 627-10-75"
                },
                {
                    name: "Прозвон 4",
                    email: "email@test.com",
                    phone: "+7 (927) 627-10-75"
                },
                {
                    name: "Прозвон 5",
                    email: "email@test.com",
                    phone: "+7 (927) 627-10-75"
                }
            ]);
        }
    }
}
