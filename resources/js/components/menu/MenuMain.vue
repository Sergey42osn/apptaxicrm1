<template v-if="isActiveMobile">
   <div class="component_container mainmenu">
        <div v-if="mobButtomShow" class="mob_menu" v-on:click.prevent="mobMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="wrapper_content">
            <div class="wrapper_content_box menu_link">
                <router-link to="/drivers" exact>Для водителей</router-link>
                <router-link to="/customers" exact>Для заказчиков</router-link>
            </div>
        </div>
   </div>
</template>

<script>

    export default {
         props: {
           // barbottmmenu:{}
         },
        data() {
            return {
                mobButtomShow:false,
               // mobile:true
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        created(){

        },
        methods:{
            mobMenu(){

            }
        },
         computed:{
          

        }
    }
</script>

<style>
.component_container.menulogin {
  position: relative;
}
.mob_menu{
    display: none;
}
.mainmenu {
  flex: 2;
}
.menu_link {
  display: flex;
  justify-content: space-around;
}
.menu_link a {
  display: inline-flex;
  padding: 5px 10px;
  background-color: #eded24;
  color: #000;
}
.menu_link a:hover{
  background-color: #969655;
}
.span_close{
    display: inline-flex;
    z-index: 999;
    position: absolute;
    right: 10px;
    top: 10px;
    width: 25px;
    height: 25px;
    justify-content: center;
    align-items: center;
    font-size: 25px;        
}
@media(max-width: 768px) {
    .wrapper_content {
  padding: 10px;
}
        .wrapper_content_box.login_link {
        display: flex;
        flex-direction: column;
        border-bottom: 1px solid;
        }
        .wrapper_content_box.login_link a {
        display: inline-flex;
        padding: 10px;
        }
    }
</style>
