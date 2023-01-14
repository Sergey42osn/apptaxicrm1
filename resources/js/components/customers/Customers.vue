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
                        <form v-on:submit.prevent="saveForm" class="form-horizontal form_register" ref="form" id="form_reg" method="POST" novalidate="">
                            
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
              
            }
        },
        methods:{
           
        },
        mounted() {
            console.log('Login mounted.');
            this.Hide();
        },
        created() {
        
        }
    }
</script>
<style>
.form_register{
    position: relative;
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
