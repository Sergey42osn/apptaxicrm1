import Vue from 'vue';
import Vuex from 'vuex'
import cars from './modules/cars'
import drivers from './modules/drivers'
import allmod from './modules/allmod'
import verifyemail from './modules/verifyemail'
import auth from './modules/auth'

Vue.use(Vuex)

export default new Vuex.Store({
	modules:{
		cars,
		drivers,
		allmod,
		verifyemail,
		auth,
	},
	actions:{
		
	},
	mutations: {
		 ADD_PAGE: (state, data) => {
	     	//console.log(data);

	     if (data) {
	     	state.showContent.pages = data;
	      	//state.pages.cars.active = data;
	     }

	      //console.log(state.pages);
	    },
	    CHANG_PAGE:(state, data) => {
	    	if (data) {

	    		//console.log(data)
		     	state.showContent.pages = data;
		      	//state.pages.cars.active = data;
		     }
	    }
	},
	state:{
		showContent:{
			nav:false,
			component:{
				name:false,
			},
			pages:false,
		},
		//pages:false
	},
	getters:{
		showContent(state){
			return state.showContent
		},
	}
});