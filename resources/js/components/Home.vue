<template>
    <div class="wrapper_app">
        <div class="wrapper_app_content">
            <div class="container">
                <div class="row justify-content-end">
                    <LoginPanel></LoginPanel>
                </div>
                <Map></Map>
            </div>
        </div>
        <BarBottom :barbottmmenu='barbottmmenu'></BarBottom>
    </div>
</template>

<script>

    import LoginPanel from './LoginPanel.vue'
    import BarBottom from './BarBottom.vue'
    import Map from './Map.vue'

    export default {
        components: {
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
        }
    }
</script>

<style>
.container{
    min-height: 100%;
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