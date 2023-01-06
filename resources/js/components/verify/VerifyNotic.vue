<template>
    <div class="container">
        <div class="row">
            <span class="text-success" v-if="success.info">{{ success.msg }}</span>
            <span class="text-errors" v-if="errorVerify">
                <p>{{ errorMsg }}</p>
                <router-link v-on:click="emailResend" :to="href" class="btn btn-primary loginboxbtn_register">Отправить ссылку активации повторно</router-link>
            </span>
            <div class="text-success" v-if="success.verify">
                <p>{{ success.msg }}</p>
                <router-link to="/login" class="btn btn-primary loginboxbtn_register">Авторизоваться</router-link>
            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        props:['messageInfo','register'],
        components: {
         
        },
        data() {
            return{
                errors: {
                    info: false,
                    msg:false,
                },
                verify:false,
                success:{
                    info:false,
                    msg:false,
                    verify:false,
                },
                verifyEmail:{
                    error:false,
                    state:false,
                },
                user_id:false,
               // href:"",
            }
        },
        methods:{
            showSuccessEmailVerify(data){

               // console.log(data);

                this.$store.commit('UPDATE_VERIFYEMAIL_STATE',data);

                this.success.msg = 'Ваш E-mail подтвержден.Можете авторизоваться';
                this.success.verify = true;

                //this.errorVerify = false;

            },
            emailResend(){
                console.log('emailResend');
            }     
        },
        created(){

           //this.getStateVerifyEmail();

        },
        computed:{
          verifyEmailState(){
             return this.$store.getters.verifyEmailState;
          },
          errorVerify(){
            return this.verifyEmailState.error;
          },
          errorMsg(){
            return this.verifyEmailState.message;
          },
          href(){
            return this.verifyEmailState.href;
          }
        },
        mounted() {

            console.log(this.$route);

            console.log(this.register);
            console.log('Component mounted.');

            if (this.register) {

                this.success.info = true;
                this.success.msg = this.messageInfo;

                this.verifyEmail.state = true;

            }else if (this.$route.query.verify) {

                this.verifyEmail.error = false;

                this.verifyEmail.state = true;

                this.showSuccessEmailVerify(this.verifyEmail);
            }
        }
    }
</script>