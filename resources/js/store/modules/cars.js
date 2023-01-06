export default{
	actions:{},
	mutations: {
	     ADD_CARS: (state, data) => {
	     	//console.log(data);

	     if (data) {
	     	state.showContent.nav = true;
	     	state.showContent.component.name = data;
	      	state.pages.cars.active = data;
	     }

	      //console.log(state.pages);
	    },
	    DELETE_CARS:(state, data) =>{
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
		},
		pages:{
			cars:{
				name:false,
				active:false
			}
		}
	},
	getters:{
		allPages(state){
			return state.pages
		},
		showContentCars(state){
			return state.showContent
		},
		showNavCars(state){
			return state.showContent
		}
	}
}