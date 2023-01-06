<template>
    <div class="component_container component_aside">
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Alexander Pierce</a>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <sideBarMenu></sideBarMenu>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
    </div>
</template>

<script>

    import sideBarMenu from './AsideAdminSidebarMenu.vue'

    export default {
        components: {
            sideBarMenu,
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
    .main-sidebar {
        height: 100%;
        background: #333333b8;
        color: #fff;
    }
    .main-sidebar a {
    color: #fff;
}
</style>