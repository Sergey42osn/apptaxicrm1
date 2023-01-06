<template>
    <div class="container">
        <div class="row">
            <div v-if="errors.info">
                <span class="text-errors">{{ errors.msg }}</span>
            <router-link to="/login" class="btn btn-primary loginboxbtn_register">Авторизоваться</router-link>
            </div>
            <div v-if="success.info">
                <span class="text-success">{{ success.msg }}</span>
            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        components: {
         
        },
        data() {
            return{
                errors: {
                    info: false,
                    msg:false,
                },
                success:{
                    info:false,
                    msg:false,
                },
            }
        },
        methods:{
            
            sendHrefEmail(){
                let url = '/api/v1/email/resend';

                axios.post(url,{
                    user_id: this.$route.query.user_id
                })
                .then(response => {
                   console.log(response.data);
                    //localStorage.setItem('user',JSON.stringify(response.data.user))
                    //localStorage.setItem('jwt',response.data.token)

                    if (response.data.result == true) {

                        console.log(response.data);

                        this.success.info = true;

                        this.success.msg = response.data.msg;

                    }else if(response.data.result == false){
                        this.errors.info = true;
                        this.errors.msg = response.data.msg;
                    }

                });
            }
        },
        created(){
            this.sendHrefEmail();
        },
        mounted() {

           //console.log(this.$route);
            //console.log('Component mounted.')
        }
    }
</script>