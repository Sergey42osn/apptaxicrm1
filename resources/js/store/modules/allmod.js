export default{
	actions:{
		widthBody ({ commit }) {
			console.log(document.body);
			commit('WIDTH_BODY')
		}
	},
	mutations: {
		WIDTH_BODY:(state) => {

			let body_width = document.body.clientWidth;

			//console.log(body_width);

			if(body_width > 770){
				state.showContent.widthBody.isActive = true;
			}else{
				state.showContent.widthBody.isActive = false;
			}

		}
	},
	state:{
		showContent:{
			nav:false,
			component:{
				name:false,
			},
			mobile:true,
			widthBody:{
				isActive:true,
			}
		},
		pages:false
	},
	getters:{
		showContentAllmod(state){
			return state.showContent
		}
	}
}