<template>
    <div class="component_container component_cars component_tab_content" v-bind:class="isActive === 'cars'?'active':''">
        <addCarsForm></addCarsForm>
    </div>
</template>

<script>

    import addCarsForm from './componentAddCarsForm.vue'

    export default {
        components: {
            addCarsForm
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
            },
        },
        methods:{
        }
    }
</script>

<style>
    .component_cars {
        display: none;
        height: 100%;
        background-color: #fff;
    }
    .component_cars.active {
        display: flex;
    }
</style>