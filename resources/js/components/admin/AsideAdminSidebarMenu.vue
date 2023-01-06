<template>
    <div class="component_container component_nav_sidebar">
        <div class="nav_sidebar_item">
        	<a @click.prevent="showNextItem(items.cars.id)" href="#">Автомобили<span class="arrow_down"></span></a>
        	<div class="nav_sidebar_item_child hide" v-bind:class="isActive === items.cars.id?'active':''">
        		<ul>
        			<li>
        				<a href="#" v-on:click.prevent="addCars(items.cars.id)">Добавить авто</a>
        			</li>
        		</ul>
        	</div>
        </div>
        <div class="nav_sidebar_item">
        	<a @click.prevent="showNextItem(items.drivers.id)" href="#">Водители<span class="arrow_down"></span></a>
        	<div class="nav_sidebar_item_child hide" v-bind:class="isActive === items.drivers.id?'active':''">
        		<ul>
        			<li>
        				<a href="#" v-on:click.prevent="addDrivers(items.drivers.id)">Добавить водителя</a>
        			</li>
        		</ul>
        	</div>
        </div>
		  <div class="nav_sidebar_item">
        	<a @click.prevent="showNextItem(items.drivers.id)" href="#">Водители<span class="arrow_down"></span></a>
        	<div class="nav_sidebar_item_child hide" v-bind:class="isActive === items.drivers.id?'active':''">
        		<ul>
        			<li>
        				<a href="#" v-on:click.prevent="addDrivers(items.drivers.id)">Добавить водителя</a>
        			</li>
        		</ul>
        	</div>
        </div>
    </div>
</template>

<script>

    import { mapGetters } from 'vuex'

    export default {
    	data() {
            return {
            	items:{
            		cars:{
            			id:"cars"
            		},
            		drivers:{
            			id:"driver"
            		}
            	},
            	isActive:false,
                isaddcarsActive:false,
                isadddriversActive:false,
            }
        },
        methods:{
            showNextItem(event){

            	this.isActive = event;

               //this. + event.target.id + Active = true;            
            },
            addCars(data){
            	console.log('123');

            	//console.log(this.$store);

                this.$store.commit('ADD_PAGE',data);

            	this.$store.commit('ADD_CARS',data);
            },
            addDrivers(data){
            	//console.log('123');

            	//console.log(this.$store);

            	this.$store.commit('ADD_PAGE_DRIVERS',data);

                 this.$store.commit('ADD_PAGE',data);
            }
        },
        mounted() {
           // console.log('Component aside menu mounted.');

            //console.log(this.$store)
        }
    }
</script>

<style>
	.nav_sidebar_item a {
    display: flex;
padding: 5px 10px;
background-color: #333;
justify-content: space-between;
align-items: center;
}
.main-sidebar a:hover {
    text-decoration: none;
    background-color: #33333369;
}
.nav_sidebar_item_child.hide{
	display: none;
}
.nav_sidebar_item_child.active {
    display: block;
}
.nav_sidebar_item_child a {
    background-color: #33333354;
}
</style>