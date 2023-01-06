<template>
    <div class="component_container menu">
        <div class="wrapper_menu">
            <div class="wrapper_menu_profil p10 mb10">
                <div class="menu_profil_img">
                    <img src="" alt="">
                </div>
                <div class="menu_profil_button">
                    <div class="menu_profil_button_text">
                        <p>Логин</p>
                        <p>000001</p>
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
                    active:'menu'
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){

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
