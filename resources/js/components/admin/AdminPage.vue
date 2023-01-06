<template>
    <div class="wrapper">
        <div class="wrapper_main">
            <!-- Navbar -->

         <asideAdmin></asideAdmin>

        <div class="wrapper_content">

            <!-- Main Sidebar Container -->

            <navMainAdmin></navMainAdmin>
        
        <!-- /.navbar -->

            <contentAdmin></contentAdmin>        

        <!-- /.content-wrapper -->
        </div>
        </div>

        <!-- Main Footer -->

        <footerAdmin></footerAdmin>
        
    </div>
</template>

<script>

    import axios from 'axios';

    import footerAdmin from './FooterAdmin.vue'
    import asideAdmin from './AsideAdmin.vue'
    import contentAdmin from './ContentAdmin.vue'
    import navMainAdmin from './navMainAdmin.vue'

    export default {
        components: {
            footerAdmin,
            asideAdmin,
            navMainAdmin,
            contentAdmin
        },
        data() {
            return {
                ///auth:false,
            }
        },
        methods:{
            
        },
        mounted() {
            //console.log('Component mounted Admin.')
        }
    }
</script>

<style>
    .wrapper{
        display: flex;
        flex-direction: column;
        height: 100vh;
    }
    .wrapper_main {
        display: grid;
        height: 100%;
        grid-template-columns: 20% 80%;
    }
    .wrapper_content {
    overflow-y: auto;
    background-color: #f4f6f9;
}
</style>