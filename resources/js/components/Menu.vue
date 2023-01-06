<template>
    <div class="component_container menu">
        <div class="wrapper_menu">
            <div class="wrapper_menu_profil p10 mb10">
                <div class="menu_profil_img">
                    <img src="" alt="">
                </div>
                <div class="menu_profil_button">
                    <router-link to="/profil" exact>
                        <p>89009009090</p>
                        <p>Показать профиль</p>
                    </router-link>
                </div>
            </div>
        </div>
        <BarBottom :barbottmmenu='barbottmmenu'></BarBottom>
    </div>
</template>

<script>

    import BarBottom from './BarBottom.vue'

    export default {
        components: {
            BarBottom
        },
        data() {
            return {
                authState:false,
                barbottmmenu:{
                    menu:true,
                    map:false,
                    active:'menu'
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            this.authState = this.$store.getters.authState.state;

            console.log(this.authState);

            if(!this.authState){
               // this.$route("/login");

                this.$router.push('/menu/login');
            }
        },
        methods:{
            
        },
        computed:{
         
        }
    }
</script>

<style>
.component_container.menu {
  min-height: 92vh;
  background-color: #f4f1f19c;
}
    .wrapper_menu_profil{
        display: flex;
        background-color: #fff;
    }
    .menu_profil_img {
  flex-basis: 20%;
}
.menu_profil_button {
  flex-basis: 80%;
  display: flex;
  justify-content: center;
}
</style>
