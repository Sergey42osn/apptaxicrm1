export default{
	actions:{
		widthBody ({ commit }) {
			commit('WIDTH_BODY')
		}
	},
	mutations: {
	    UPDATE_AUTH_STATE: (state, data) => {
	     	console.log(data);

	     if (data) {
	     	state.authState.state = true;
	     }else{
			state.authState.state = false;
		  }

	      //console.log(state.pages);
	    },
		 WIDTH_BODY:(state)=>{
			console.log(document.body);
		}
	},
	state:{
		authState:{
			state:false,
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