<template>
    <div class="container">
        <div class="row">
            verifay
            <span class="text-success" v-if="success.info">{{ success.msg }}</span>
            <span class="text-errors" v-if="errors.info">
                <p>{{ errors.msg }}</p>
                <router-link :to="href" class="btn btn-primary loginboxbtn_register">Отправить ссылку активации повторно</router-link>
            </span>
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
                href:"#",
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
            getStateVerifyEmail(){
                let url = '/api/v1/email/verify/check';

                console.log(url);

                axios.get(url)
                .then(response => {
                   console.log(response.data);
                    //localStorage.setItem('user',JSON.stringify(response.data.user))
                    //localStorage.setItem('jwt',response.data.token)

                    if (response.data.result == true) {


                    }else{
                       // this.errors.info = true;
                       // this.errors.msg = response.data.msg;
                       // this.href = response.data.href;
                    }

                });
            },
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


                    }else{
                        this.errors.info = true;
                        this.errors.msg = response.data.msg;
                    }

                });
            }
        },
        created(){

           //this.getStateVerifyEmail();

        },
        mounted() {

            console.log(this.$route);
            console.log('Component mounted.')
        }
    }
</script>