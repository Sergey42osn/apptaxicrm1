export default{
	actions:{},
	mutations: {
	     ADD_PAGE_DRIVERS: (state, data) => {
	     	//console.log(data);

	     if (data) {
	     	state.showContent.nav = true;
	     	state.showContent.component.name = data;
	      	//state.pages.cars.active = data;
	     }

	      //console.log(state.pages);
	    },
	    DELETE_PAGE_DRIVERS:(state, data) =>{
	    	state.showContent.nav = false;
	      	state.showContent.component.name = false;
	    }
	},
	state:{
		showContent:{
			nav:false,
			component:{
				name:false,
			},
		}
	},
	getters:{
		driversPage(state){
			return state.pages
		},
		showContentDrivers(state){
			return state.showContent
		},
		showNavDrivers(state){
			return state.showContent
		}
	}
}