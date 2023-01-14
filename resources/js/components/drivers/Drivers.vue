<template>
    <div class="container drivers">
        <ContentDriver v-if="auth" :phone="phone"></ContentDriver>
        <MenuLoginDrivers v-else></MenuLoginDrivers>
    </div>
</template>

<script>

    import MenuLoginDrivers from '../drivers/MenuLogin.vue'
    import ContentDriver from '../drivers/ContentDriver.vue'

    export default {
        components: {
            MenuLoginDrivers,
            ContentDriver,
        },
        data() {
            return{
                phone:false,               
            }
        },
        methods:{
           
        },
        mounted() {
            console.log('Login mounted.');
        },
        created() {
            this.$store.dispatch('GET_USER_PROFILE');
        },
        computed:{
            auth(){
                console.log(this.getUser )
                this.showContent = true;
                if(this.getUser){
                    return true;
                }else{return false}
            },
            authState(){
                //console.log(this.$store.getters.authState);
                return this.$store.getters.authState.state;
            },
            login(){
                return this.getUser.id_driver;
            },
            getUser(){
                return this.$store.getters.getUserProfile;
            }
        }
    }
</script>
<style>
.form_register{
    position: relative;
}
.menu_link {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  padding: 20px 0;
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
