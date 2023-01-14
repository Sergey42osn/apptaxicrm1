export default{
	actions:{
		GET_USER_PROFILE: async (context) => {

			let access_token = window.localStorage.getItem('token');

			if(!access_token){
				context.commit('UPDATE_AUTH_STATE', false);
			}else{

				let headers = {
					'Content-Type': 'application/json',
					'Authorization': 'Bearer '+ access_token
				}
				
				let {data} = await axios.get('/api/v1/getdriver',{method: 'GET',headers});
	
				console.log(data);

				if(data.result == true){
					context.commit('GET_USER_PROFILE', data.user);
				}else{
					context.commit('GET_USER_PROFILE', false);
				}
			}


			//commit('UPDATE_ACCESS_TOKEN',payload);
		},
	},
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
		},
		GET_USER_PROFILE:(state, data) => {
			state.user = data;
			state.driver = data;
		}
	},
	state:{
		showContent:{
			nav:false,
			component:{
				name:false,
			},
		},
		barBottomDrivers:{
			menu:false,
			order:false,
			map:true
		},
		user:false,
		driver:false,
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
		},
		getUserProfile(state){
			return state.user
		},
		getDriverProfile(state){
			return state.driver
		},
		barBottomDrivers(state){
			return state.barBottomDrivers
		}
	}
}