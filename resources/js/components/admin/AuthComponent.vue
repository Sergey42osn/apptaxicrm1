<template>
    <div></div>
</template>

<script>

    import axios from 'axios';

    export default {
         // props:['onAuth'],
        data() {
            return {
               //onAuth:true,
            }
        },
        methods:{
            isAuth(){

                  let url = "/api/v1/auth";

                     let token = window.localStorage.getItem('token');

                    if (token) {

                        axios.defaults.headers = {
                            'Content-Type': 'application/json',
                            Authorization: 'Bearer ' + token
                        }

                    }else{
                      this.$emit('onAuth', {
                        auth: false
                      });

                      this.$router.push('/register');

                      return;
                    }
                     
                    axios.get(url)
                    .then(response => {
                     console.log(response.data);

                      if (response.data.result == true) {
                        this.auth = true;

                        this.user.name = response.data[0].name;
                      }

                    });

                this.$emit('onAuth', {
                  auth: true
                })
            }
        },
        mounted() {

            console.log('Component mounted onAuth.');

             console.log(this.onAuth);

            this.isAuth();
        }
    }
</script>