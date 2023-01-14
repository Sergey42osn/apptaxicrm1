<template>
   <div class="component_container content_driver">
        <MapDrivers v-if="auth"></MapDrivers>
        <ProfileDrivers v-else></ProfileDrivers>
        <BarBottomDrivers></BarBottomDrivers>
   </div>
</template>

<script>

    import ProfileDrivers from '../drivers/ProfileDrivers.vue';
    import MapDrivers from '../drivers/MapDrivers.vue';
    import BarBottomDrivers from '../drivers/BarBottomDrivers.vue';

    export default {
        components: {
            ProfileDrivers,
            MapDrivers,
            BarBottomDrivers,
        },
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
                return this.getUserProfile.phone;
            },
            auth(){
                return this.getUserProfile.id_driver
            },
            getUserProfile(){
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
