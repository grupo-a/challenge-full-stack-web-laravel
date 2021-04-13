import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';

Vue.use(Vuetify);

export default new Vuetify({
  theme: {
    themes: {
      light: {
        primary: '#00aeb5',
        secondary: '#db1639',
        accent: '#8c9eff',
        error: '#b71c1c',
      },
    },
  },
});
