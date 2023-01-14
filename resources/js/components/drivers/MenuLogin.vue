<template>
   <div class="component_container menulogin">
        <span class="span_close" v-on:click.prevent="closeMenuLogin">x</span>
        <div class="wrapper_content">
            <div class="wrapper_content_box" v-if="auth">
                <Profil></Profil>
            </div>
            <div class="wrapper_content_box login_link" v-else>
                <router-link to="/drivers/login" exact>Войти</router-link>
                <router-link to="/drivers/register" exact>Зарегестрироваться</router-link>
            </div>
        </div>
   </div>
</template>

<script>

    import Profil from '../Profil.vue'

    export default {
        components: {
            Profil
        },
         props: {
           // barbottmmenu:{}
         },
        data() {
            return {
                showContent:false,
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
            auth(){
                this.showContent = true;
                return this.authState.state;
            },
            authState(){
                console.log(this.$store.getters.authState);
               return this.$store.getters.authState;
            },
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
.login_link {
  display: flex;
  justify-content: space-around;
  padding: 10px 0;
}
.login_link a {
  display: inline-flex;
  padding: 10px 15px;
  background-color: #eded24;
}
.login_link a:hover{
  background-color: #969655;
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
