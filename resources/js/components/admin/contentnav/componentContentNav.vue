<template>
    <div class="component_container component_content_nav">
        <div class="box_flex">
            <ul class="content_nav">
                <componentContentNavCars v-if="showcars"></componentContentNavCars>
                <componentContentNavDrivers v-if="showdrivers"></componentContentNavDrivers>
            </ul>
        </div>
    </div>
</template>

<script>

    import { mapGetters } from 'vuex'

   import componentContentNavCars from './componentContentNavCars.vue'
   import componentContentNavDrivers from './componentContentNavDrivers.vue'

    export default {
        data() {
            return {
                isClass:false,
            }
        },
        components: {
           componentContentNavCars,
           componentContentNavDrivers,
        },
        mounted() {
            //console.log('Component con.');

           // console.log(cars);
        },
        computed:{
            showcars(){
                return this.showContentCars.nav;
            },
            showdrivers(){
                return this.showContentDrivers.nav;
            },
            showContentDrivers(state){
                return this.$store.getters.showContentDrivers;
            },
             showContentCars(state){
                return this.$store.getters.showContentCars;
            },
        },
        methods:{
            removePageCars(){
                this.$store.commit('DELETE_CARS',false);
            },
            changPage(){

            }
        }
    }
</script>

<style>
    .content_nav {
    display: flex;
}
.content_nav_item {
    position: relative;
    display: inline-flex;
}
.content_nav_item.active {
    background-color: #fff;
}
.content_nav_item a {
    display: flex;
    padding: 5px 10px;
}
.content_nav_item a.active {
    background-color: #fff;
}
.content_nav_item .del {
    position: absolute;
    display: block;
    top: 0;
    right: 0;
    cursor: pointer;
}
</style>