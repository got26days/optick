
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueCarousel from 'vue-carousel';
Vue.use(VueCarousel);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('mainreview', require('./components/Mainreview.vue'));
Vue.component('partners', require('./components/Partners.vue'));
Vue.component('pagination', require('laravel-vue-pagination'));

import 'viewerjs/dist/viewer.css'
import Viewer from 'v-viewer'
import Vue from 'vue'
Vue.use(Viewer)
import MaskedInput from 'vue-masked-input'


const app = new Vue({
    el: '#app',
    components: {
      MaskedInput
    },
    data(){
      return{
          maincard: 1,
          name: '',
          phone: '',
          option0: true,
          option1: false,
          option2: false,
          option3: false,
          option4: false,
          option5: false,
          option6: false,
          price: 'asc',
          sendbrand: 'Все',
          catalogs: {},
          brands: [],
          images: [
            'https://picsum.photos/200/200',
            'https://picsum.photos/300/200',
            'https://picsum.photos/250/200'
          ]
      }
    },
    methods: {
      getCatalog(page = 1){
        axios.get(`/getcatalog?page=` + page, { params: {
          option0: this.option0,
          option1: this.option1,
          option2: this.option2,
          option3: this.option3,
          option4: this.option4,
          option5: this.option5,
          option6: this.option6,
          price: this.price,
          brand: this.sendbrand,
        } })
        .then(response => {
          this.catalogs = response.data;
        })
        .catch(e => {
          alert('Ошибка, повторите еще раз!')
        })
      },
      postNow(){
        axios.post('/sendmessage', {
          name: this.name,
          phone: this.phone
        })
        .then(response => {
          alert('Данные успешно отправлены!');
        })
        .catch(e => {
          alert('Ошибка, повторите еще раз.');
        })
      },
      getBrands(){
        axios.get(`/getbrands`)
        .then(response => {
          this.brands = response.data;
        })
        .catch(e => {
          alert('Ошибка, повторите еще раз!')
        })
      },
      getParams(){
        if(window.location.href.indexOf("catalog") > -1) {

          let searchParams = new URLSearchParams(window.location.search)
          if(searchParams.has('state1')){
            this.option0 = false;
            this.option1 = searchParams.get('state1')
          }
          if(searchParams.has('state2')){
            this.option0 = false;
            this.option2 = searchParams.get('state2')
          }
          if(searchParams.has('state3')){
            this.option0 = false;
            this.option3 = searchParams.get('state3')
          }
          if(searchParams.has('state4')){
            this.option0 = false;
            this.option4 = searchParams.get('state4')
          }
          if(searchParams.has('state5')){
            this.option0 = false;
            this.option5 = searchParams.get('state5')
          }
          if(searchParams.has('state6')){
            this.option0 = false;
            this.option6 = searchParams.get('state6')
          }
        }
        this.getCatalog();
      }
    },
    filters: {
      imagelink: function (value) {
        return '/storage/' +  value;
      },
      linkfilter: function (value) {
        return '/catsolo/id' + value;
      }
    },
    created(){
      this.getBrands();
      this.getParams();
    }
});
