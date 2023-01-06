<template>

    <li class="content_nav_item" v-bind:class="isActive === 'driver'?'active':''">
        <a href="#" class="" @click.prevent="changPage('driver')">Водители</a><span class="del" @click.prevent="removePage">x</span>
    </li>

</template>

<script>

    import { mapGetters } from 'vuex'

    export default {
        mounted() {
            //console.log('Component con.');

           // console.log(cars);
        },
        computed:{
           isActive(){
                return this.showContent.pages;
            },
            showContent(){
                return this.$store.getters.showContent;
            }
        },
        methods:{
            removePage(){
                this.$store.commit('DELETE_PAGE_DRIVERS',false);
            },
            changPage(data){
                this.$store.commit('CHANG_PAGE',data);
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