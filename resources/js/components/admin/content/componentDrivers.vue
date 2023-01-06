<template>
    <div class="component_container component_drivers component_tab_content" v-bind:class="isActive ==='driver'?'active':''">
        <addDriversForm></addDriversForm>
    </div>
</template>

<script>

    import addDriversForm from './componentAddDriversForm.vue'

    export default {
        components: {
            addDriversForm
        },
        mounted() {
           // console.log('Component mounted.')
        },
         computed:{
            showContent(){
                return this.$store.getters.showContent;
            },
            isActive(){
                 return this.showContent.pages;
            }
        },
        methods:{
        }
    }
</script>

<style>
    .component_drivers {
        display: none;
        height: 100%;
        background-color: #fff;
    }
    .component_cars.active {
        display: flex;
    }
</style>