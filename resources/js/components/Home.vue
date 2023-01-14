<template>
    <div class="wrapper_app">
        <div class="wrapper_app_content">
            <div class="container">
                <div class="row_menu">
                    <MenuMain v-if="isActiveMobile"></MenuMain>
                    <LoginPanel></LoginPanel>
                </div>
                <Map></Map>
            </div>
        </div>
        <BarBottom :barbottmmenu='barbottmmenu'></BarBottom>
    </div>
</template>

<script>

    import MenuMain from './menu/MenuMain.vue'
    import LoginPanel from './LoginPanel.vue'
    import BarBottom from './BarBottom.vue'
    import Map from './Map.vue'

    export default {
        components: {
            MenuMain,
            LoginPanel,
            Map,
            BarBottom
        },
        data() {
            return {
                barbottmmenu:{
                    menu:false,
                    map:true,
                    active:'map'
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
            this.$store.dispatch('USER_AUTH');
        },
        computed:{
            isActiveMobile(){

            // console.log(this.$store.getters.showContentAllmod);

            return this.showContentAllmod.widthBody.isActive;
            },

            showContentAllmod(){

            //console.log(this.$store.getters.showContentAllmod);

            return this.$store.getters.showContentAllmod;
            }
        }
    }
</script>

<style>
.container{
    min-height: 100%;
}
.row_menu{
    display: flex;
    padding: 10px 0;
}
    .wrapper_app_content {
    height: 93vh;
    }
    .mob_bottom_bar_box.active {
  background-color: #000;
}
    @media(max-width: 768px) {
           .wrapper_app_content .container {
  padding: 0;
}
    }
</style>