export default{
	actions:{
		UPDATE_ACCESS_TOKEN(context, payload) {
			console.log(payload);
			commit('UPDATE_ACCESS_TOKEN',payload);
		},
		USER_AUTH: async (context) => {
			let access_token = window.localStorage.getItem('token');
			//console.log(access_token);
			if(!access_token){
				context.commit('UPDATE_AUTH_STATE', false);
			}else{

				let headers = {
					'Content-Type': 'application/json',
					'Authorization': 'Bearer '+ access_token
			  	}

				let {data} = await axios.get('/api/v1/user',{method: 'GET',headers});

				console.log(data);

				if(data.result == true){
					context.commit('UPDATE_AUTH_STATE', true);
				}else{
					context.commit('UPDATE_AUTH_STATE', false);
				}
			}
		}
	},
	mutations: {
	    UPDATE_AUTH_STATE: (state, data) => {
	     	//console.log(data);

	     if (data) {
	     	state.authState.state = true;
	     }else{
			state.authState.state = false;
		  }

	      //console.log(state.pages);
	    },
		UPDATE_ACCESS_TOKEN: (state, data) => {
				//console.log(data);

			window.localStorage.setItem('token',data);

			//console.log(window.localStorage.getItem('token'));
	  }		
	},
	state:{
		authState:{
			state:false,
			access_token:false,
		},
		widthBody:{
			isActive:false,
		}
	},
	getters:{
		authState(state){
			return state.authState
		}
	}
}