<template>
    <div class="component_container login_panel">
        <div v-if="auth" class="wrapper_content">
            <span>{{ userName }}</span>
            <form v-on:submit.prevent="logoutForm" action="">
                <button>Выйти</button>
            </form>
            <span v-if="userAdmin">
              <router-link to="/admin" exact>Админ панель</router-link>
            </span>
			<span v-if="userProfil">
              <router-link to="/profil" exact>Профиль</router-link>
            </span>
        </div>
        <div v-else class="wrapper_content" v-bind:class="{ active: isActive }">
            <router-link to="/login" exact>Войти</router-link>
            <router-link to="/register" exact>Зарегестрироваться</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        props:['authuser'],
        data() {
            return {
               // auth:false,
                isActive: false,
                body:false,
            }
        },
        mounted() {
            console.log('Component mounted.');
           // this.widthBody();
          //  this.$store.dispatch('widthBody');
        },
        created(){

           //this.getAuth();

        },
        methods:{
             logedIn(){

                 console.log('logedIn');

                     let url = "/api/v1/user";

                     let token = window.localStorage.getItem('token');

                    if (token) {

                        axios.defaults.headers = {
                            'Content-Type': 'application/json',
                            Authorization: 'Bearer ' + token
                        }

                    }else{

                      this.$store.commit('UPDATE_AUTH_STATE',false);

                      return;

                    }
                     
                    axios.get(url)
                    .then(response => {
                     // console.log(response.data);

                      if (response.data.result == true) {

                        this.user.admin = response.data.user.is_admin;

                        this.user.name = response.data.user.name;

                        this.$store.commit('UPDATE_AUTH_STATE',true);
                      }

                    });

            },
            logoutForm(){
                let url = "/api/v1/logout";

                    let token = this.authState.access_token;

                    //console.log(token);

                    axios.defaults.headers = {
                            'Content-Type': 'application/json',
                            Authorization: 'Bearer ' + token
                    }
                     
                    axios.post(url)
                    .then(response => {
                    //  console.log(response.data);

                      if (response.data.result == true) {
                    // console.log(response.data);

                       //window.localStorage.setItem('token','');

                       this.$store.commit('UPDATE_AUTH_STATE',false);

                       this.$store.dispatch('UPDATE_ACCESS_TOKEN',false);

                       this.$store.dispatch('USER_AUTH');
                      // window.location.reload();
                      }


                    })
                    .catch(error => {
                        console.log(error.response);
                        if(error.response.data.errors){
                           console.log(error.response.data.errors);

                           let err = error.response.data.errors;

                           let $name = Object.keys(err);
                           //console.log($name[0]); 
                           let vals = Object.values(err);
                          // console.log(vals[0][0]); 

                           // console.log(this.errors.info);

                            this.errors[$name[0]] = vals[0][0];
                        }
                    });
            },
            getAuth(){
               // console.log(this.$store.getters.authState);

            }
        },
        computed:{
        authState(){
           // console.log(this.$store.getters.authState);
            return this.$store.getters.authState;
        },
        auth(){
           // console.log(this.authState);
             return this.authState.state;
        },
        userName(){
          //  console.log(this.authState.user.name);
            if(this.authState.user.name){
                return this.authState.user.name;
            }else{
                return false;
            }
        },
        userAdmin(){
            if(this.authState.user.is_admin){
                return this.authState.user.is_admin;
            }else{
                return false;
            }
        },
        userProfil(){
            if(this.authState.user){
                return true;
            }else{
                return false;
            }
        }
        }
    }
</script>

<style>
     @media(max-width: 768px) {
        .component_container.login_panel {
            display: none;
        }
    }
</style>
