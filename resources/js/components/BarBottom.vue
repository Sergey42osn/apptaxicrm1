<template>
   <div class="component_container bottom_bar">
      <div class="wrapper_app_mob_bottom_bar">
         <div class="mob_bottom_bar_box"></div>
         <div class="mob_bottom_bar_box" v-bind:class="{ active: barbottmmenu.map }">
            <router-link to="/" exact>
                  <img src="" alt="">
               <p>Карта</p>
            </router-link>
         </div>
         <div v-if="authState" class="mob_bottom_bar_box" v-bind:class="{ active: barbottmmenu.order }">            
            <div class="mob_bottom_bar_box_order" v-on:click.prevent="order('yes')">
               <p>Заказать</p>
            </div>
         </div>
         <div v-else class="mob_bottom_bar_box" v-bind:class="{ active: barbottmmenu.order }">
            <div class="mob_bottom_bar_box_order" v-on:click.prevent="order('no')">
               <router-link to="/login" exact>
                  <img src="" alt="">
                  <p>Заказать</p>
               </router-link>
            </div>
         </div>
         <div class="mob_bottom_bar_box"></div>
         <div class="mob_bottom_bar_box" v-bind:class="{ active: barbottmmenu.menu }">
            <div class="mob_bottom_bar_box_menu">
               <router-link to="/menu" exact>
                  <span class="mob_menu_button">
                     <span></span>
                     <span></span>
                     <span></span>
                  </span>
                  <p>Меню</p>
               </router-link>
            </div>
         </div>
      </div>
      <div class="wrapper_order_modal" v-show="visible">
         <div class="order_modal_overlay"></div>
         <div class="order_modal_content">
            <div class="order_modal_content_box">
               <p>Для заказа машины перейдите в карту и нажмите на авто</p>
               <p class="btn btn_modal"><span v-on:click="visible=!visible">Перейти</span></p>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
    export default {
         props: {
            barbottmmenu:{}
         },
        data() {
            return {
               map:'',
               menu:'',
               visible:false
            }
        },
        mounted() {
            console.log('Component mounted.');

            console.log(this.barbottmmenu)
        },
        created(){

        },
        methods:{
            order(data){
               console.log(data);
               if(data == 'yes'){
                  this.visible = true;
                  this.$router.push('/');
               }
            },
            mobMenu(){

            }
        },
         computed:{
            authState(){
             // console.log(this.$store.getters.authState.state);
             return this.$store.getters.authState.state;
          },          
        }
    }
</script>

<style>
.component_container.bottom_bar {
position: fixed;
bottom: 0;
left: 0;
right: 0;
}
.wrapper_app_mob_bottom_bar{
        display: flex;
        width: 100%;
        background-color: #403838;
        padding: 5px;
    }
     .mob_bottom_bar_box{
        display: flex;
        flex-direction: column;
        align-items: center;
justify-content: center;
flex-basis: 25%;
     }
     .mob_menu_button span{
        display: inline-flex;
        width: 20px;
        height: 2px;
        background-color: #fff;
     }
     .mob_bottom_bar_box a {
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.mob_menu_button {
  display: inline-flex;
  flex-direction: column;
  align-items: center;
}
.mob_menu_button span + span {
  margin-top: 4px;
}
.mob_bottom_bar_box_menu p {
  display: flex;
  justify-content: center;
  margin: 0;
}
.mob_bottom_bar_box_order p {
  color: #fff;
}
.mob_bottom_bar_box a {
   color:#fff;
}
.wrapper_order_modal {
  position: fixed;
  z-index: 99999;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}
.order_modal_overlay {
  position: absolute;
  display: flex;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background-color: #000;
  opacity: 0.6;
}
.order_modal_content {
  position: relative;
  background-color: #fff;
  z-index: 9;
  width: 90%;
  padding: 10px;
}
.btn.btn_modal {
  display: flex;
  justify-content: center;
}
.btn.btn_modal span {
  display: inline-flex;
  padding: 5px 10px;
  background-color: #3e3e3e;
  color: #fff;
}
     @media(min-width: 768px) {
        .wrapper_app_mob_bottom_bar {
            display: none;
        }
    }
</style>
