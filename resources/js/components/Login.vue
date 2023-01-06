<template>
    <div class="component_container login">
        <span class="span_close" v-on:click.prevent="closeMenuLogin">x</span>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div v-if="register" class="wrapper_info success"><p>{{ messageInfo }}</p></div>
                    <div class="box_flex flex_column wrapper_content">
                        <div class="panel-heading">Авторизация</div>
                    
                        <div class="alert alert-info" v-if="info">{{ message }}</div>
                        <div class="alert alert-danger" v-if="errors.info">{{ message }}</div>
                        <div class="alert alert-success" v-if="success.info">{{ message }}</div>
                        <div class="panel-body">
                            <form v-on:submit.prevent="saveForm" class="form-horizontal form_login" method="POST" action="" novalidate="">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input
                                        id="email"
                                        type="email"
                                        class="form-control"
                                        v-model="email"
                                        data-required="Введите email"
                                        v-on:change="chang($event)"
                                        v-on:keyup="chang($event)"
                                        v-on:onfocus="chang($event)"
                                        value=""
                                        placeholder="Введите e-mail"
                                        v-on:click="chang($event)"
                                        autofocus>
                                        <span v-if="errors.email" class="help-block help_block_validate">
                                            <strong>{{ errors.email }}</strong>
                                        </span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        name="password"
                                        v-model="password"
                                        data-required="Введите пароль"
                                        v-on:change="chang($event)"
                                        v-on:keyup="chang($event)"
                                        v-on:onfocus="chang($event)"
                                        placeholder="Введите пароль">         
                                        <span v-if="errors.password" class="help-block help_block_validate">
                                            <strong>{{ errors.password }}</strong>
                                        </span>
                
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember">Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="loginboxbtn_login">
                                            <button type="submit" class="btn btn-primary loginboxbtn_submit">
                                            Войти
                                        </button>
                                        <a class="btn btn-primary loginboxbtn_reset" href="">
                                            Восстановить пароль?
                                        </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="loginboxbtn">
                                    <router-link to="/register" class="btn btn-primary loginboxbtn_register">Зарегестрироваться</router-link>
                                
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        props:['messageInfo','register'],
        data() {
            return {
                name : "",
                email : "",
                password : "",
                errors: {
                    name:false,
                    email: false,
                    password: false,
                    info:false,
                    verifyemail:false,
                },
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                info: false,
                message: false,
               // message_info: false,
                success:{
                    info:false
                },
                verifyemail:{
                    state:false,
                    message:false,
                    error:true,
                    href:"",
                },
                loggedIn:false,
                 headers: false,
            }
        },
        methods:{
            Hide(){
               this.$emit('Hide'); 
            },
             chang:function(event) {
                //console.log(event.target);
                var $name = event.target.id;
                var val = event.target.value;
                var required = event.target.dataset.required;
              // console.log(val);
                if (val == "") {
                   // console.log($name);
                    this.errors[$name] = required;
                }else{
                    //console.log($name);
                    this.errors[$name] = false;
                    //this.errors[$name] = true;
                }
               
                let errors =false;
               //console.log(this.errors);
            },
             saveForm: function(event){
                // event.preventDefault(e);
                console.log(event);

                this.info = false;
                this.errors.info = false;

                let errors = false;

                if (this.email == "") {
                    this.errors.email = "Заполните e-mail";
                    errors = true;
                }
                if (this.password == "") {
                    this.errors.password = "Введите пароль";
                    errors = true;
                }
                if (errors) {
                     console.log(this.errors);
                    return this.errors;
                }else{

                     let url = "/api/v1/login";
                 
                    axios.post(url, {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                      console.log(response.data);
                        //localStorage.setItem('user',JSON.stringify(response.data.user))
                        //localStorage.setItem('jwt',response.data.token)

                        if (response.data.error) {

                            if (response.data.error == 'verifyemail') {

                                console.log(response.data.error);

                                this.verifyemail.message = response.data.message;

                                this.verifyemail.href = response.data.href;

                                this.updateVerifyEmailState(this.verifyemail);

                            }

                        }else if (response.data.result == true) {

                            if (response.data.token) {

                                this.verifyemail.state = true;
                            this.verifyemail.error = false;

                            this.updateVerifyEmailState(this.verifyemail);

                            window.localStorage.setItem('token',response.data.token);

                            //this.message = response.data.message;
                           // this.success.info = true;

                           // this.loggedIn = true;

                           this.$emit('loggedIn',true);

                            this.$router.push('/');
                            }

                        }

 
                      /*  if (localStorage.getItem('jwt') != null){
                            this.$emit('loggedIn')
                            if(this.$route.params.nextUrl != null){
                                this.$router.push(this.$route.params.nextUrl)
                            }
                            else{
                                this.$router.push('/')
                            }
                        }*/


                    });
                }

            },
            loggedin(){
                 console.log('Запрос.');

                this.token = window.localStorage.getItem('token');

                if (this.token) {
                    this.headers = {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer '+ this.token
                    }

                    axios.get('/api/v1/auth',{
                         method: 'POST',
                        headers:this.headers
                        })
                       .then(response => {
                            console.log(response.data);

                            if (response.data.result == true) {

                               //window.localStorage.getItem('token');

                               // this.nameUser = response.data.name;
                              //  this.loggedIn = true;

                               // this.$emit(this.nameUser);

                              // this.$router.push('/');

                            }
                       })
                       .catch(function (error) {
                        // handle error
                        console.log(error);
                      });                    
                }
            },
            updateVerifyEmailState(data,colback){
                this.$store.commit('UPDATE_VERIFYEMAIL_STATE',data);

                 this.$router.push('/email/verify/notic/');
            },
            closeMenuLogin(){
                this.$router.push('/');
            }
        },
        computed:{
          
        },
        mounted() {
            console.log('Login mounted.');
           //this.Hide();
           this.loggedin();
        }
    }
</script>
<style>
.wrapper_info {
    display: flex;
    justify-content: center;
}
.wrapper_info.success p {
    color:green;
}
.component_container.login {
    position: relative;
}
@media(max-width: 768px) {
.component_container.login {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
.loginboxbtn_login {
  display: flex;
  flex-direction: column;
  gap: 20px 0;
}
.loginboxbtn_register {
  display: flex;
  justify-content: center;
}
.panel-heading {
  margin: 20px 0;
  text-align: center;
  font-size: 20px;
}
}
</style>