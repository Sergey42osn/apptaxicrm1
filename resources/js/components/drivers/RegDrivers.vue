<template>
    <div class="container drivers">
        <div class="row">
            <div class="col-sm-6 mx-auto">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Регистрация</h3></div>

                    <div class="panel-body">
                        <div v-if="info" class="info info">
                            <span class="text-success" v-if="success.info">{{ success.info }}</span>
                        </div>
                        <form v-on:submit.prevent="saveForm" v-bind:class="{ ajax: isAjax }" class="form-horizontal form_register" ref="form" id="form_reg" method="POST" novalidate="">
                            
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group">

                                <div class="form-group_box">
                                    <input id="name"
                                            type="text"
                                            class="form-control"
                                            v-model="name"
                                            v-on:click="chang($event)"
                                            v-on:change="chang($event)"
                                            v-on:onfocus="chang($event)"
                                            v-on:keyup="chang($event)"
                                            data-required="Введите имя"
                                            value=""
                                            placeholder="Введите имя"
                                            autofocus>
                                    <span v-if="errors.name" class="help-block help_block_validate">
                                            <strong>{{ errors.name }}</strong>
                                        </span>
                        
                                </div>
                                
                            </div>
                            <div class="form-group">
                             <div class="form-group_box">
                                <input id="f_name"
                                        type="text"
                                        class="form-control"
                                        v-model="f_name"
                                        v-on:click="chang($event)"
                                        v-on:change="chang($event)"
                                        v-on:onfocus="chang($event)"
                                        v-on:keyup="chang($event)"
                                        data-required="Введите фамилию"
                                        value=""
                                        placeholder="Введите фамилию"
                                        autofocus>
                                <span v-if="errors.f_name" class="help-block help_block_validate">
                                        <strong>{{ errors.f_name }}</strong>
                                    </span>                    
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="form-group_box">
                                    <input id="email"
                                            type="email"
                                            class="form-control"
                                            v-model="email"
                                            v-on:click="chang($event)"
                                            v-on:change="chang($event)"
                                            data-required="Заполните E-mail"
                                            placeholder="Введите e-mail"
                                            required>

                                        <span v-show="errors.email" class="help-block help_block_validate">
                                            <strong>{{ errors.email }}</strong>
                                        </span>
                            
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="form-group_box">
                                    <input id="phone"
                                            type="phone"
                                            class="form-control"
                                            v-model="phone"
                                            v-on:click="chang($event)"
                                            v-on:change="chang($event)"
                                            v-on:keyup="keyup($event)"
                                            v-on:keydown="keydown($event)"
                                            data-required="Введите телефон"
                                            placeholder="Введите телефон"
                                            required>

                                        <span v-show="errors.phone" class="help-block help_block_validate">
                                            <strong>{{ errors.phone }}</strong>
                                        </span>
                            
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="form-group_box">
                                    <input id="password"
                                            type="password"
                                            class="form-control"
                                            v-model="password"
                                            v-on:click="chang($event)"
                                            v-on:change="chang($event)" 
                                            v-on:keyup="keyup($event)"
                                            data-required="Введите пароль"
                                            placeholder="Введите пароль"
                                            required>

                            
                                        <span v-show="errors.password" class="help-block help_block_validate">
                                            <strong>{{ errors.password }}</strong>
                                        </span>
                        
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="form-group_box">
                                    <input id="password_confirmation"
                                            type="password"
                                            class="form-control"
                                            v-model="password_confirmation"
                                            v-on:click="chang($event)"
                                            v-on:change="chang($event)"
                                            v-on:keyup="keyup($event)"
                                            data-required="Подтвердите пароль"
                                            placeholder="Подтвердите пароль">

                                        <span v-show="errors.password_confirmation" class="help-block help_block_validate">
                                            <strong>{{ errors.password_confirmation }}</strong>
                                        </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group_box">
                                    <button type="submit" class="btn btn-primary mx-auto">
                                        Зарегестрироваться
                                    </button>
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return{
                name : "",
                f_name : "",
                email : "",
                phone:"",
                password : "",
                password_confirmation : "",
                errors: {
                    name:false,
                    f_name:false,
                    email: false,
                    phone:false,
                    password: false,
                    password_confirmation: false,
                    info: false
                },
                isAjax:false,
                success:{info:false},
                info: false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods:{
            chang:function(event) {
               // console.log(event.target);
                var $name = event.target.id;
                var val = event.target.value;
                var required = event.target.dataset.required;
              // console.log(this.$refs.form);
                if (val == "") {
                   // console.log($name);
                    this.errors[$name] = required;
                }else{
                    //console.log($name);
                    this.errors[$name] = false;
                    //this.errors[$name] = true;
                }
                if ($name == "password" && this.password != "") {
                    //console.log(this.password.length);
                    if (this.password.length < 6) {
                       this.errors[$name] = "Пароль не менее 6 символов"; 
                       return;
                    }
                    if (this.password_confirmation == "") {
                        this.errors.password_confirmation = "Подтвердите пароль";
                    }
                    if (this.password != this.password_confirmation) {
                        this.errors[$name] = "Пароли не совпадают"; 
                    }else{
                        this.errors[$name] = false; 
                    }
                }
                if ($name == "password_confirmation") {
                    if (this.password != this.password_confirmation) {
                        this.errors.password = "Пароли не совпадают"; 
                    }else{
                        this.errors.password = false;
                    }
                    if (this.password.length < 6) {
                       this.errors.password = "Пароль не менее 6 символов"; 
                    }
                }
                if ($name == "phone") {
                    this.getPhoneMack(event)
                }
                let errors =false;
             //  console.log(this.errors);
            },
            keydown(event){
                let $name = event.target.id;

                if ($name == 'phone') {

                    //console.log(this.errors[$name]);

                    if(event.keyCode == '8'){
                        return;
                    }

                    if(this.errors[$name] == false){

                        this.errors[$name] = 'Не более 11 цифр';

                        event.preventDefault();
                        return;
                    }

                    this.getPhoneMack(event)

                }
            },
            keyup(event){
                //console.log(event.target.id);

                let $name = event.target.id;

               // console.log($name);

                if ($name == 'phone') {

                    //console.log(this.errors[$name]);

                    //if(this.errors[$name] === false)return;

                    this.getPhoneMack(event);

                }
                if($name == 'password'){
                    
                     this.chang(event);
                }
                if($name == 'password_confirmation'){
                    
                     this.chang(event);
                }

               // console.log(length);

            },
            getPhoneMack(event){
           // console.log(event.target.id);

            let $name = event.target.id;

             var val = event.target.value;

                val = val.replace(/[^0-9]/giu,"");

               // console.log(val);

                let length = val.length;

                if (length <11) {

                   //  console.log(length);

                  //  console.log(val);

                  //  console.log(length);

                    this.errors[$name] = 'Не менее 11 цифр';

                    //return;
                }else if(length == 11){

                    if(event.keyCode == '8'){
                        return;
                    }

                    this.errors[$name] = false;

                    this.phone = val;

                   // console.log(event);

                    //event.preventDefault();

                    //return false;

                }else if(length > 11){

                    this.errors[$name] = false;

                //this.phone = val;

                   // console.log(event);

                    //event.preventDefault();

                    //return false;

                }

            },
            Hide(){
               this.$emit('Hide'); 
            },
            saveForm: function(event){
                // event.preventDefault(e);
                 //console.log(event);
               //console.log(this.phone.length);

                     this.info = false;
                     this.success.info = false;
                     this.errors.info = false;

                    let errors = false;

                    if (this.name == "") {
                        this.errors.name = "Введите имя";
                        errors = true;
                    }
                    if (this.f_name == "") {
                        this.errors.f_name = "Введите имя";
                        errors = true;
                    }
                    if (this.phone == "") {
                        this.errors.phone = "Введите телефон";
                        errors = true;
                    }
                    if (this.phone) {
                        let val_phone = this.phone;

                        val_phone = val_phone.replace(/[^0-9]/giu,"");

                       // console.log(val_phone);

                        if(val_phone.length < 10){
                            this.errors.phone = "Введите 11 цифр";
                            errors = true;
                        }
                    }
                    if (this.email == "") {
                        this.errors.email = "Заполните e-mail";
                        errors = true;
                    }
                    if (this.password == "") {
                        this.errors.password = "Введите пароль";
                        errors = true;
                    }
                    if (this.password_confirmation == "") {
                        this.errors.password_confirmation = "Повторите пароль";
                        errors = true;
                    
                    }
                    if (errors) {
                         console.log(this.errors);
                        return this.errors;
                    }

                if (this.password === this.password_confirmation)
                {
                    this.isAjax = true;

                    console.log(this.password);
                    let url = "/api/v1/drivers/register";
                 
                    axios.post(url, {
                        name: this.name,
                        f_name: this.f_name,
                        phone: this.phone,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation 
                    })
                    .then(response => {
                       console.log(response.data);
                        //localStorage.setItem('user',JSON.stringify(response.data.user))
                        //localStorage.setItem('jwt',response.data.token)

                        if (response.data.result == true) {

                            this.$emit("registerIn",true);

                            this.$router.push(response.data.href);

                        }

                        if (response.data.errors) {

                            console.log(response.data.errors);

                            this.errors.info = response.data.errors;
                            this.info = true;
                            
                        }else if (response.data.success) {

                            this.success.info = response.data.success;
                            this.info = true;

                            this.name = '';
                            this.email = '';
                            this.password = '';
                            this.password_confirmation = '';

                            //this.RegForm.reset();

                             event.target.reset();
                        }

                        this.isAjax = false;

                    }).catch(error => {
                      //  console.log(error.response);
                        if(error.response.data.errors){
                          // console.log(error.response.data.errors);

                           let err = error.response.data.errors;

                           let $name = Object.keys(err);
                           //console.log($name[0]); 
                           let vals = Object.values(err);
                          // console.log(vals[0][0]); 

                           // console.log(this.errors.info);

                            this.errors[$name[0]] = vals[0][0];
                        }

                        this.isAjax = false;
                    });


                } else {
                    
                     this.errors.password = "Пароли не совпадают";

                         console.log(this.errors);
                         return this.errors;
                }
            }
        },
        mounted() {
            console.log('Login mounted.');
            this.Hide();
        },
        created() {
            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
        }
    }
</script>
<style>
.form_register{
    position: relative;
}
.form_register.ajax:before{
    position: absolute;
    content: '';
    display: flex;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    z-index: 999;
    background-color: #fff;
    opacity: 0.6;
    cursor: wait;
}
.help_block_validate {
    color: red;
}
@media(max-width: 768px) {
    .panel-heading {
  margin-bottom: 20px;
}
    .form-group_box {
        position: relative;
    }
    .form-group {
  margin-bottom: 2rem;
}
     .help-block {
         top: -17px;
        left: 0 !important;
        transform: translate(0) !important;
        font-size: 12px;
    }
}
</style>
