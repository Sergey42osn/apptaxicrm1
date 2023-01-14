<template>
   <div class="component_container content_driver">
        <div class="component_container_box profile">777
            <router-link to="/drivers/profil" exact>
                <div class="profile_img">
                    <img src="" alt="">
                </div>
                <div class="profile_info">
                    <div class="profile_info_phone">{{ phone }}</div>
                    <div class="profile_info_text">Показать профиль</div>
                </div>
            </router-link>
        </div>
   </div>
</template>

<script>

    export default {
         props: {
            //phone:false,
           // barbottmmenu:{}
         },
        data() {
            return {
            }
        },
        mounted() {
            console.log('Component mounted.');
        },
        created(){
            //this.$store.dispatch('GET_USER_PROFILE');
        },
        methods:{
            closeMenuLogin(){
            },
            mobMenu(){

            }
        },
         computed:{
            phone(){
                return this.getUser.phone;
            },
            getUser(){
                return this.$store.getters.getUserProfile;
            }
        }
    }
</script>

<style>
.component_container.menulogin {
  position: relative;
}
.component_container_box.profile {
  padding: 10px 0;
}
.component_container_box.profile a {
  display: flex;
}
.profile_img,
.profile_info{
  flex: 1;
}
</style>
