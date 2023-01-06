<template>
   <div class="component_container menulogin">
        <span class="span_close" v-on:click.prevent="closeMenuLogin">x</span>
        <div class="wrapper_content">
            <div class="wrapper_content_box login_link">
                <router-link to="/login" exact>Войти</router-link>
                <router-link to="/register" exact>Зарегестрироваться</router-link>
            </div>
        </div>
   </div>
</template>

<script>
    export default {
         props: {
           // barbottmmenu:{}
         },
        data() {
            return {
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        created(){

        },
        methods:{
            closeMenuLogin(){
                this.$router.push('/');
            },
            mobMenu(){

            }
        },
         computed:{
          
        }
    }
</script>

<style>
.component_container.menulogin {
  position: relative;
}

    .span_close{
        display: inline-flex;
        z-index: 999;
        position: absolute;
        right: 10px;
        top: 10px;
        width: 25px;
        height: 25px;
        justify-content: center;
        align-items: center;
        font-size: 25px;        
    }
    @media(max-width: 768px) {
        .wrapper_content {
  padding: 10px;
}
        .wrapper_content_box.login_link {
        display: flex;
        flex-direction: column;
        border-bottom: 1px solid;
        }
        .wrapper_content_box.login_link a {
        display: inline-flex;
        padding: 10px;
        }
    }
</style>
