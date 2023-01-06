<template>
    <div class="component_container component_content">
        <componentContentNav></componentContentNav>
        <componentCars v-if="showcars"></componentCars>
        <componentDrivers v-if="showdrivers"></componentDrivers>
    </div>
</template>

<script>

    import axios from 'axios';
    import { mapGetters } from 'vuex'

    import componentCars from './content/componentCars.vue'
    import componentDrivers from './content/componentDrivers.vue'
    import componentContentNav from './contentnav/componentContentNav.vue'

    export default {
        data(){
            return{
             // show: this.$store.state.showContent,
             //show:false
            }
        },
        components: {
           componentCars,
           componentDrivers,
           componentContentNav,
        },
        computed: {
            showcars(){
                return this.showContentCars.nav;
            },
             showContentCars(state){
                return this.$store.getters.showContentCars;
            },
            showdrivers(){
                return this.showContentDrivers.nav;
            },
            showContentDrivers(state){
                return this.$store.getters.showContentDrivers;
            },
        },
        mounted() {
        }
    }
</script>

<style>
    .component_content {
        min-height: 100%;
    }
    .component_tab_content{
        display: none;
    }
    .component_tab_content.active{
        display: flex;
    }
</style>