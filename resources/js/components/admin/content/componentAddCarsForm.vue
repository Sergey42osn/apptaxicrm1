<template>
    <div class="component_container component_cars_add_form">
        <div class="alert alert-danger" v-if="errors.info">{{ message }}</div>
            <div class="alert alert-success" v-if="success.info">{{message }}</div>
        <form v-on:submit.prevent="saveForm" action="" method="POST" novalidate="">
            <div class="form-group form_group_column">
                <label for="">Выберете категорию авто</label>
                <div class="box_input">
                    <select
                    v-on:change="chang($event)"
                    v-bind:carscat="carscat"
                    name="carscat"
                    id="carscat"
                    >
                        <option v-for="cat in cats" :value="cat.id">{{ cat.name_category }}</option>
                    </select>
                    <a class="add_cars_cat" href="#" title="Добавить категорию авто" @click.prevent="openForm('cat')">+</a>
                </div>
            </div>
            <div v-if="brands" class="form-group form_group_column">
                <label for="">Выберете марку авто</label>
                <div class="box_input">
                    <select
                    v-on:change="chang($event)"
                    v-bind:carsbrand="carsbrand"
                    name="carsbrand"
                    id="carsbrand"
                    >
                        <option v-for="brand in brands" :value="brand.id">{{ brand.name_model }}</option>
                    </select>
                    <a class="add_cars_brand" href="#" title="Добавить марку авто" @click.prevent="openForm('brand')">+</a>
                </div>
            </div>
            <div v-if="models" class="form-group form_group_column">
                <label for="">Выберете модель авто</label>
                <div class="box_input">
                    <select
                    v-on:change="chang($event)"
                    v-bind:carsmodel="carsmodel"
                    name="carsmodel"
                    id="carsmodel"
                    >
                        <option v-for="model in models" :value="model.id">{{ model.name_car }}</option>
                    </select>
                     <a class="add_cars_model" href="#" title="Добавить модель авто" @click.prevent="openForm('model')">+</a>
                </div>
            </div>
             <div v-if="colors" class="form-group form_group_column">
                <label for="">Выберете цвет авто</label>
                <div class="box_input">
                    <select
                    v-on:change="chang($event)"
                    v-bind:carscolor="carscolor"
                    name="carscolor"
                    id="carscolor"
                    >
                        <option v-for="color in colors" :value="color.id">{{ color.name_color }}</option>
                    </select>
                     <a class="add_cars_model" href="#" title="Добавить цвет авто" @click.prevent="openForm('color')">+</a>
                </div>
            </div>
             <div class="form-group form_group_column">
                <label for="">Введите гос. номер авто</label>
                <div class="box_input">
                    <input
                    v-model="carsnamber"
                    v-bind:carsnamber="carsnamber"
                    name="carsnamber"
                    id="carsnamber"
                    >
                </div>
                <label for="">x000xx142</label>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="loginboxbtn_login">
                        <button type="submit" class="btn btn-primary loginboxbtn_submit">
                        Сохранить
                    </button>
                    </div>
                </div>
            </div>
        </form>
        <div v-if="addForm === 'cat'" class="box_form_add_cat">
            <form v-on:submit.prevent="addCarsCat" action="">
                <label for="">Введите категорию авто</label>
                <input
                type="text"
                v-model="namecat"
                >
                <button type="submit" class="btn btn-primary loginboxbtn_submit">
                        Сохранить
                </button>
            </form>
        </div>
        <div v-if="addForm === 'brand'" class="box_form_add_cat">
            <form v-on:submit.prevent="addCarsBrand($event)" action="">
                <label for="">Введите марку авто авто</label>
                <input
                type="text"
                v-model="namebrand"
                >
                <label for="">Выберите категорию авто</label>
                <select
                v-on:change="changadd($event)"
                v-bind:idcat="idcat"
                name="idcat"
                id="idcat"
                >
                    <option v-for="cat in cats" :value="cat.id">{{ cat.name_category }}</option>
                </select>
                <button type="submit" class="btn btn-primary loginboxbtn_submit">
                        Сохранить
                </button>
            </form>
        </div>
        <div v-if="addForm === 'model'" class="box_form_add_cat">
            <form v-on:submit.prevent="addCarsModel($event)" action="">
                <label for="">Введите модель авто</label>
                <input
                type="text"
                v-model="namemodel"
                >
                <label for="">Выберите категорию авто</label>
                <select
                v-on:change="changadd($event)"
                v-bind:idcat="idcat"
                name="idcat"
                id="idcat"
                >
                    <option v-for="cat in cats" :value="cat.id">{{ cat.name_category }}</option>
                </select>
                <label for="">Выберите марку авто</label>
                <select
                v-on:change="changadd($event)"
                v-bind:idbrand="idbrand"
                name="idbrand"
                id="idbrand"
                >
                    <option v-for="brand in brands" :value="brand.id">{{ brand.name_model }}</option>
                </select>
                <button type="submit" class="btn btn-primary loginboxbtn_submit">
                        Сохранить
                </button>
            </form>
        </div>
        <div v-if="addForm === 'color'" class="box_form_add_cat">
            <form v-on:submit.prevent="addCarsColor($event)" action="">
                <label for="">Введите цвет авто</label>
                <input
                type="text"
                v-model="namecolor"
                >
                <button type="submit" class="btn btn-primary loginboxbtn_submit">
                        Сохранить
                </button>
            </form>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
         data() {
            return {
                carscat : '',
                carsbrand : '',
                carsmodel : "",
                carscolor:'',
                carsnamber:'',
                idcat:'',
                idmodel:'',
                idbrand:'',
                message:'',
                errors: {
                    name:false,
                    email: false,
                    password: false,
                    info:false,
                    carsnamber:false,
                    carscat:false,
                    carscolor:false,
                    car_namber:false,
                },
                success:{
                    info:false,
                },
                cats:false,
                brands:false,
                models:false,
                colors:false,
                addForm:false,
                namecat:'',
                namebrand:'',
                namemodel:'',
                namecolor:"",
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        mounted() {
        console.log('Component component_cars_add_form.')

           this.getCarsCats();

           this.getCarsColors();
        },
         computed:{
        
        },
        methods:{
            saveForm: function(event){
                // event.preventDefault(e);
               // console.log(event);

                this.info = false;
                this.errors.info = false;

                if (this.carsnamber == "") {
                    this.errors.carsnamber = "Заполните номер авто";
                    return;
                }else if (this.carscat == '' || !parseInt(this.carscat)) {
                    this.errors.carscat = "Не выбрана категория авто";
                    return;
                }
                else if (this.carsbrand == '' || !parseInt(this.carsbrand)) {
                    this.errors.carsbrand = "Не выбрана марка авто";
                    return;
                }
                else if (this.carsmodel == '' || !parseInt(this.carsmodel)) {
                    this.errors.carsmodel = "Не выбрана модель авто";
                    return;
                }
                 else if (this.carscolor == '' || !parseInt(this.carscolor)) {
                    this.errors.carscolor = "Не выбран цвет авто";
                    return;
                }
                else if (this.carscolor == '' || !parseInt(this.carscolor)) {
                    this.errors.carscolor = "Не выбран цвет авто";
                    return;
                }

                let url = "/api/v1/admin/addcar";
             
                axios.post(url, {
                    id_model: this.carsmodel,
                    id_brand: this.carsbrand,
                    id_category: this.carscat,
                    id_color: this.carscolor,
                    car_namber: this.carsnamber
                })
                .then(response => {
                 console.log(response.data);
                    //localStorage.setItem('user',JSON.stringify(response.data.user))
                    //localStorage.setItem('jwt',response.data.token)

                    if (response.data.result == true) {

                         console.log(response.data);

                         this.success.info = true;
                         this.message = response.data.message;

                    }else{

                        if (response.data.message) {

                            let mes = response.data.message;

                            for (var prop in mes) {
                                // этот код будет вызван для каждого свойства объекта
                                // ..и выведет имя свойства и его значение
                                console.log( prop + ": " + mes[prop] );

                                this.message = mes[prop];
                            }

                            this.errors.info = true;

                       }
                    }


                });

            },
            getCarsCats(){
                let url = "/api/v1/admin/getcarscats";

                axios.get(url)
                    .then(response => {
                     // console.log(response.data);

                      if (response.data.result == true) {

                        // console.log(response.data[0]);

                         this.cats = response.data[0];

                         this.idcat = response.data[0][0].id;

                         this.carscat = response.data[0][0].id;

                         this.getCarBrands(this.carscat);

                      }

                });
            },
            getCarsColors(){
                let url = "/api/v1/admin/getcarscolors";

                axios.get(url)
                    .then(response => {
                     // console.log(response.data);

                      if (response.data.result == true) {

                       //  console.log(response.data[0]);

                         this.colors = response.data[0];

                         this.carscolor = response.data[0][0].id;

                      }

                });
            },
            getCarBrands(cat_id){
                let url = "/api/v1/admin/getcarbrands";

               // console.log(cat_id);

               //return;

                axios.post(url,{
                    cat_id: cat_id
                })
                .then(response => {
                 // console.log(response.data);

                  if (response.data.result == true) {

                     //console.log(response.data);

                     this.brands = response.data[0];

                     this.carsbrand = response.data[0][0].id;

                     this.idbrand = response.data[0][0].id;

                     this.getCarModels(this.carsbrand);

                  }

                });
            },
             getCarModels(cat_id){
                let url = "/api/v1/admin/getcarmodels";

               // console.log(cat_id);

               //return;

                axios.post(url,{
                    cat_id: cat_id
                })
                .then(response => {
                 // console.log(response.data);

                  if (response.data.result == true) {

                     //console.log(response.data);

                     this.models = response.data[0];

                     this.carsmodel = response.data[0][0].id;

                  }

                });
            },
            addCarsCat(){
                let url = "/api/v1/admin/addcarscat";

                //console.log(this.namecat);

                let namecat = this.namecat;

               // return;

                if (namecat == '') {
                    return;
                }

                axios.post(url,{
                    namecat:namecat
                })
                .then(response => {
                 // console.log(response.data);

                  if (response.data.result == true) {

                    // console.log(response.data);

                     this.addForm = false;

                     this.getCarsCats();

                  }

                });
            },
            addCarsBrand(event){
               // console.log(event.target);

                let url = "/api/v1/admin/addcarsbrand";

                let namebrand = this.namebrand;

                let id_cat = this.idcat;

               // return;

                if (namebrand == '' || id_cat == '') {
                    return;
                }

                axios.post(url,{
                    namebrand:namebrand,
                    id_cat:id_cat
                })
                .then(response => {
                 // console.log(response.data);

                  if (response.data.result == true) {

                     //console.log(response.data);

                     this.addForm = false;

                     this.getCarBrands(this.idcat);
                  }

                });
            },
            addCarsModel(event){
                //console.log(event.target);

                let url = "/api/v1/admin/addcarsmodel";

                let namemodel = this.namemodel;

                let id_cat = this.idcat;

                let id_brand = this.idbrand;

               // return;

                if (namemodel == '' || id_cat == '' || id_brand == '') {
                    return;
                }

                axios.post(url,{
                    namemodel:namemodel,
                    id_cat:id_cat,
                    id_brand:id_brand
                })
                .then(response => {
                 // console.log(response.data);

                  if (response.data.result == true) {

                     //console.log(response.data);

                     this.addForm = false;

                     this.getCarModels(this.idbrand);
                  }

                });

            },
             addCarsColor(event){
                //console.log(event.target);

                let url = "/api/v1/admin/addcarscolor";

                let namecolor = this.namecolor;

               // return;

                if (namecolor == '') {
                    return;
                }

                axios.post(url,{
                    namecolor:namecolor
                })
                .then(response => {
                 // console.log(response.data);

                  if (response.data.result == true) {

                     console.log(response.data);

                     this.addForm = false;

                     this.getCarsColors();
                  }

                });

            },
            openForm(data){

                console.log(data);

                //return;

                this.addForm = data;
            },
            chang: function(event){
                //console.log(event.target.value);

                var $name = event.target.id;

                this[$name] = event.target.value;
            },
            changadd: function(event){
               // console.log(event.target);

                var $name = event.target.id;

                this[$name] = event.target.value;

               // console.log(this[$name]);

                //this.carscat = event.target.value;
            }
        }
    }
</script>

<style>
    .component_cars_add_form {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        align-items: center;
    }
    .form-group {
        display: flex;
    }
    .form_group_column {
        flex-direction: column;
    }
    .box_input {
        display: flex;
    }
    .add_cars_cat,
    .add_cars_brand,
    .add_cars_model {
        display: block;
        padding: 5px 10px;
        margin-left: 20px;
        background-color: #bfb7b7;
    }
    .box_form_add_cat {
        position: absolute;
        top: 14px;
        z-index: 99999;
        background: #fff;
padding: 100px;
    }
    .box_form_add_cat form {
    display: flex;
    flex-direction: column;
}
</style>