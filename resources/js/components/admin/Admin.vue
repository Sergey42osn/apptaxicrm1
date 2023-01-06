<template>
    <div>
        <AuthComponent @onAuth="onAuth"></AuthComponent>
        <AdminPage v-if="auth"></AdminPage>
    </div>
</template>

<script>

    import axios from 'axios'

    import AdminPage from './AdminPage.vue'
    import AuthComponent from './AuthComponent.vue'

    export default {
        components: {
            AdminPage,
            AuthComponent,
        },
        data() {
            return {
               auth:false,
             //onAuth:false
            }
        },
        methods:{
            onAuth(data){

                console.log(data);

                this.auth = data.auth;
            }
        },
        mounted() {
            console.log('Component mounted Admin.')
        }
    }
</script>
<style>
    .arrow_down {
    position: relative;
display: block;
width: 8px;
height: 8px;
}
.arrow_down:after {
content: '';
position: absolute;
border-right: 1px solid;
height: 10px;
transform: rotate(-45deg);   
}
.arrow_down:before {
  content: '';
position: absolute;
border-left: 1px solid;
height: 10px;
right: 0;
transform: rotate(45deg);
}
li{
    list-style: none;
}
ul{
    margin: 0;
    padding: 0;
}
a,a:hover{
    text-decoration: none;
}
</style>