<template>
    <div class="component_container component_cars_add_form">
        <form v-on:submit.prevent="saveForm" action="" method="POST" novalidate="">
            <div class="alert alert-danger" v-if="errors.info">{{ message }}</div>
            <div class="alert alert-success" v-if="success.info">{{message }}</div>
            <div class="form-group form_group_column">
                <div class="box_input">
                    <label for="">Фамилия</label>
                    <input
                    v-model="f_name"
                    type="text"
                    id="f_name"
                    name="f_name"
                    data-required="Введите фамилию"
                    v-on:change="chang($event)"
                    >
                     <span v-if="errors.f_name" class="help-block help_block_validate">
                        <strong>{{ errors.f_name }}</strong>
                    </span>
                </div>
            </div>
            <div class="form-group form_group_column">
                <div class="box_input">
                   <label for="">Имя</label>
                    <div class="box_input">
                        <input
                        v-model="name"
                        type="text"
                        id="f_name"
                        name="f_name"
                        data-required="Введите имя"
                        v-on:change="chang($event)"
                        v-on:keyup="chang($event)"
                        >
                        <span v-if="errors.email" class="help-block help_block_validate">
                            <strong>{{ errors.name }}</strong>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group form_group_column">
                <div class="box_input">
                    <label for="">Телефон</label>
                    <div class="box_input">
                        <input
                        v-model="phone"
                        type="text"
                        id="phone"
                        name="phone"
                        data-required="Введите телефон"
                        v-on:change="chang($event)"
                        v-on:keyup="keyup($event)"
                        >
                        <span v-if="errors.phone" class="help-block help_block_validate">
                            <strong>{{ errors.phone }}</strong>
                        </span>
                    </div>
                </div>
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
    </div>
</template>

<script>

    import axios from 'axios';

    //import MaskedInput from 'vue-masked-input';

    export default {
        components: {
         // MaskedInput
        },
         data() {
            return {
                f_name : '',
                name : '',
                phone : "",
                errors: {
                    info:false,
                    name:false,
                    f_name: false,
                    password: false,
                    info:false,
                    phone:false
                },
                success:{
                    info:false,
                    message:false
                },
                message:false,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        mounted() {
        console.log('Component component_cars_add_form.')

        },
         computed:{
        
        },
        methods:{
            saveForm: function(event){
                // event.preventDefault(e);
                console.log(event);

                this.info = false;
                this.errors.info = false;

                if (this.f_name == "") {
                    this.errors.f_name = "Введите фамилию";
                    return;
                }
                if (this.name == "") {
                    this.errors.name = "Введите имя";
                    return;
                }
                 if (this.phone == "") {
                    this.errors.phone = "Введите телефон";
                    return;
                }

                 let url = "/api/v1/admin/addriver";
             
                axios.post(url, {
                    f_name: this.f_name,
                    name: this.name,
                    phone: this.phone,
                    confirmed: true
                })
                .then(response => {
                  console.log(response.data);
                    //localStorage.setItem('user',JSON.stringify(response.data.user))
                    //localStorage.setItem('jwt',response.data.token)

                    if (response.data.result == true) {

                      //  console.log(response.data.errors);

                        this.message = response.data.message;
                        this.success.info = true;
                    }else if (response.data.result == false) {

                       if (response.data.message) {

                            let mes = response.data.message;

                            for (var prop in mes) {
                                // этот код будет вызван для каждого свойства объекта
                                // ..и выведет имя свойства и его значение
                                console.log( prop + ": " + mes[prop] );

                                this.errors[prop] = mes[prop];
                            }

                       }
                    }
                });

            },
            chang:function(event) {
                //console.log(event.target);
                var $name = event.target.id;
                var val = event.target.value;
                var required = event.target.dataset.required;
              // console.log(val);
                if (val == "") {
                    console.log($name);
                    this.errors[$name] = required;
                    return;
                }else if(val.length <3){
                    this.errors[$name] = 'Не менее 3 символов';
                    return;
                }
                else{
                    console.log($name);
                    this.errors[$name] = false;
                    //this.errors[$name] = true;
                }
               
                let errors =false;
               console.log(this.errors);
            },
            keyup(event){
                //console.log(event.target.id);

                let $name = event.target.id;

                if ($name == 'phone') {

                    this.getPhoneMack(event)

                }

               // console.log(length);

            },
            getPhoneMack(event){
            console.log(event.target.id);

            let $name = event.target.id;

             var val = event.target.value;

                val = val.replace(/[^0-9]/giu,"");

                console.log(val);

                let length = val.length;

                if (length <10) {

                    console.log(val);

                    console.log(length);

                    this.errors[$name] = 'Поле должно содержать не менее 11 цифр';

                    return;
                }else{

                    this.errors[$name] = false;

                    this.phone = val;

                }

            },
            getCarsCats(){
                let url = "/api/v1/admin/getcarscats";

                axios.get(url)
                    .then(response => {
                     // console.log(response.data);

                      if (response.data.result == true) {

                         console.log(response.data[0]);

                         this.cats = response.data[0];

                         this.idcat = response.data[0][0].id;

                         this.carscat = response.data[0][0].id;

                         this.getCarBrands(this.carscat);

                      }

                });
            },
            getCarBrands(cat_id){
                let url = "/api/v1/admin/getcarbrands";

                console.log(cat_id);

               //return;

                axios.post(url,{
                    cat_id: cat_id
                })
                .then(response => {
                 // console.log(response.data);

                  if (response.data.result == true) {

                     console.log(response.data);

                     this.brands = response.data[0];

                     this.carsbrand = response.data[0][0].id;

                     this.idbrand = response.data[0][0].id;

                     this.getCarModels(this.carsbrand);

                  }

                });
            },
             getCarModels(cat_id){
                let url = "/api/v1/admin/getcarmodels";

                console.log(cat_id);

               //return;

                axios.post(url,{
                    cat_id: cat_id
                })
                .then(response => {
                 // console.log(response.data);

                  if (response.data.result == true) {

                     console.log(response.data);

                     this.models = response.data[0];

                     this.idmodel = response.data[0][0].id;

                  }

                });
            },
            addCarsCat(){
                let url = "/api/v1/admin/addcarscat";

                console.log(this.namecat);

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

                     console.log(response.data);

                     this.addForm = false;

                     this.getCarsCats();

                  }

                });
            },
            addCarsBrand(event){
                console.log(event.target);

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

                     console.log(response.data);

                     this.addForm = false;

                     this.getCarBrands(this.idcat);
                  }

                });
            },
            addCarsModel(event){
                console.log(event.target);

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

                     console.log(response.data);

                     this.addForm = false;

                     this.getCarModels(this.idbrand);
                  }

                });

            },
            openForm(data){

                console.log(data);

                //return;

                this.addForm = data;
            },
            changadd: function(event){
                console.log(event.target);

                var $name = event.target.id;

                this[$name] = event.target.value;

                console.log(this[$name]);

                //this.carscat = event.target.value;
            }
        }
    }
</script>

<style>
    .component_cars_add_form {
        position: relative;
        display: flex;
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
        position: relative;
        display: flex;
    }
    .help-block {
        position: absolute;
        right: 0;
        transform: translateX(100%);
    }
</style>