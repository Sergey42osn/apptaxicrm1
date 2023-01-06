import Vue from 'vue'
import Vuex from 'vuex'
import Cars from './modules/cars'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    Cars
  }
})