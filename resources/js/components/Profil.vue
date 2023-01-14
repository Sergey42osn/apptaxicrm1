<template>
    <div class="component_container menu">
        <div class="wrapper_menu">
            <div class="wrapper_menu_profil p10 mb10">
                <div class="menu_profil_img">
                    <img src="" alt="">
                </div>
                <div class="menu_profil_button">
                    <div class="menu_profil_button_text">
                        <span>Логин</span>
                        <span>{{ login }}</span>
                    </div>
                    <div class="menu_profil_button_icon"></div>
                </div>
            </div>
            <div class="wrapper_menu_profil p10 mb10">
                <div class="menu_profil_img">
                    <img src="" alt="">
                </div>
                <div class="menu_profil_button">
                    <div class="menu_profil_button_text">
                        <span>Номер телефона</span>
                        <span>{{ phone }}</span>
                    </div>
                    <div class="menu_profil_button_icon"></div>
                </div>
            </div>
            <div class="wrapper_menu_profil p10 mb10">
                <div class="menu_profil_img">
                    <img src="" alt="">
                </div>
                <div class="menu_profil_button">
                    <div class="menu_profil_button_text">
                        <span>Автомобиль</span>
                        <span>{{ car_name }} {{ car_color }} {{ car_namber }}</span>
                    </div>
                    <div class="menu_profil_button_icon"></div>
                </div>
            </div>
        </div>
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
                barbottmmenu:{
                    menu:true,
                    map:false,
                    active:'menu',
                    user:false,
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            this.$store.dispatch('GET_USER_PROFILE');
        },
        methods:{
            
        },
        computed:{
            login(){
                return this.getUser.id_driver;
            },
            phone(){
                return this.getUser.phone;
            },
            getUser(){
                return this.$store.getters.getUserProfile;
            }
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
.menu_profil_button_text {
  display: flex;
  flex-direction: column;
}
</style>
