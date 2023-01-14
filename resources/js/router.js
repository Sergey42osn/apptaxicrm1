import VueRouter from 'vue-router';

//import App from './components/App';
import Home from './components/Home.vue';
import Login from './components/Login.vue';
import Menu from './components/Menu.vue';
import MenuLogin from './components/menu/MenuLogin.vue';
import Profil from './components/Profil.vue';
import Register from './components/Register.vue';
import Drivers from './components/drivers/Drivers.vue';
import MenuLoginDrivers from './components/drivers/MenuLogin.vue';
import ContentDriver from './components/drivers/ContentDriver.vue';
import MenuMain from './components/menu/MenuMain.vue';
import Customers from './components/customers/Customers.vue';
import RegDrivers from './components/drivers/RegDrivers.vue';
import LoginDrivers from './components/drivers/LoginDrivers.vue';
import ProfileDrivers from './components/drivers/ProfileDrivers.vue';
import MapDrivers from './components/drivers/MapDrivers.vue';
import BarBottomDrivers from './components/drivers/BarBottomDrivers.vue';
import DriversMenu from './components/drivers/DriversMenu.vue';
import RegCustomers from './components/customers/RegCustomers.vue';
import Admin from './components/admin/Admin.vue';
import Verify from './components/verify/Verify.vue';
import Resend from './components/verify/Resend.vue';
import VerifyNotic from './components/verify/VerifyNotic.vue';
import NoticResetPwd from './components/verify/drivers/NoticResetPwd.vue';


//import Indax from './components/admin/Index';
//import Register from './components/Register';

import axios from 'axios';


export default new VueRouter({
	routes: [
		{
			path: '/',
			component : Home
		},
		{
			path: '/login',
			component : Login
		},
		{
			path: '/register',
			component : Register
		},
		{
			path: '/drivers',
			component : Drivers
		},
		{
			path: '/customers',
			component : Customers
		},
		{
			path: '/drivers/register',
			component : RegDrivers
		},
		{
			path: '/drivers/login',
			component : LoginDrivers
		},
		{
			path: '/drivers/menu',
			component : LoginDrivers
		},
		{
			path: '/menu',
			component : Menu
		},
		{
			path: '/menu/login',
			component : MenuLogin
		},
		{
			path: '/profil',
			component : Profil
		},
		{
			path: '/drivers/profil',
			component : Profil
		},
		{
			path: '/admin',
			component : Admin
		},
		{
			path: '/email/verify',
			component : Verify
		},
		{
			path: '/email/verify/notic',
			component : VerifyNotic
		},
		{
			path: '/email/verify/drivers/noticpwd',
			component : NoticResetPwd
		},
		{
			path: '/email/resend/',
			component : Resend
		}
	],
	mode : 'history'
})