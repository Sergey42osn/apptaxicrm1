export default{
	actions:{},
	mutations: {
	    UPDATE_VERIFYEMAIL_STATE: (state, data) => {
	     	console.log(data);

	     if (data) {
	     	state.verifyEmail.state = data.state;
	     	state.verifyEmail.message = data.message;
	     	state.verifyEmail.error = data.error;
	     	state.verifyEmail.href = data.href;
	     }

	      //console.log(state.pages);
	    },
	},
	state:{
		verifyEmail:{
			state:false,
			message:false,
			error:true,
			href:"",
		}
	},
	getters:{
		verifyEmailState(state){
			return state.verifyEmail
		}
	}
}