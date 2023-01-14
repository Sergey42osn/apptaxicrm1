export default{
	actions:{
		UPDATE_ACCESS_TOKEN(context, payload) {
			//console.log(payload);
			context.commit('UPDATE_ACCESS_TOKEN',payload);
		},
		USER_AUTH: async (context) => {
			let access_token = window.localStorage.getItem('token');

			//access_token = false;
		//	console.log(access_token);
			if(!access_token){
				context.commit('UPDATE_AUTH_STATE', false);
				context.commit('UPDATE_ACCESS_TOKEN', false);
			}else{

				context.commit('UPDATE_ACCESS_TOKEN', access_token);

				let headers = {
					'Content-Type': 'application/json',
					'Authorization': 'Bearer '+ access_token
			  	}

				let {data} = await axios.get('/api/v1/user',{method: 'GET',headers});

				//console.log(data);

				if(data){
					context.commit('UPDATE_AUTH_STATE', data);
				}else{
					context.commit('UPDATE_AUTH_STATE', data);
					context.commit('UPDATE_ACCESS_TOKEN', false);
				}
			}
		}
	},
	mutations: {
	    UPDATE_AUTH_STATE: (state, data) => {
	    // 	console.log(data);

	     if (data.result) {
	     	state.authState.state = true;
			  state.authState.user = data.user;
	     }else{
			state.authState.state = false;
			state.authState.user = false;
		  }

	      //console.log(state.pages);
	    },
		UPDATE_ACCESS_TOKEN: (state, data) => {
				//console.log(data);

			window.localStorage.setItem('token',data);

			state.authState.access_token = data;

			//console.log(window.localStorage.getItem('token'));
	  }		
	},
	state:{
		authState:{
			state:false,
			access_token:false,
			user:false,
		},
		widthBody:{
			isActive:false,
		}
	},
	getters:{
		authState(state){
			return state.authState
		},
		getUserAuth: state => {
			return state.authState.user
		},
	}
}