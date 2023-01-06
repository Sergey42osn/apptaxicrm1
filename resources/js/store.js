let store = {
	state: {
    showContent:false,
    namePage:{
    	cars:false,
    },
    activePage:{
    	cars:false,
    }
  },
  mutations: {
     ADD_CARS: (state, data) => {
     	console.log(data);
      state.showContent = data;
      state.namePage.cars = data;
      state.activePage.cars = data;

      console.log(state);
    },
    DELETE_CARS:(state, data) =>{
    	state.namePage.cars = data;
      	state.activePage.cars = data;
    }
  }
};

export default store;