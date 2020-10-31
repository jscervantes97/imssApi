const app = new Vue(
    {
        'el': '#app',
        'store': new Vuex.Store(
            {
                state: {
                    count: 0,
                    usuario : object
                },
                mutations: {
                    increment (state) {
                        state.count++
                    },
                    asignarUsuario(state){

                    }

                }
            }
        ),
        'methods': {
            'buttonClick': function() {
                this.$store.commit('increment')
            }
        }
    }
);