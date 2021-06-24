/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: axios } = require('axios');
const { includes, forEach } = require('lodash');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    mounted() {
        if (window.location.pathname == '/') {
            var categoryApi = 'api/guests/dishes_categories';
            axios.get(categoryApi)
            .then(result => {
                // console.log(result);
                this.categories = result.data.results;
            });
        };

        if (window.location.pathname == '/guest/order/create') {
            this.amountFunction();
        };
    },
    created() {
        this.amountFunction();
    },
    data() {
        return {
            amount: '',
            url: 'https://payments.sandbox.braintree-api.com/graphql',
            payment_status: '',
            boolean: false,
            restaurants : '',
            collection : '',
            categories : false,
            selected_category : '',
            searchFilter : '',
            flag : false,
            flag_cart : true,
            quantity_dish : [],
            names_dish : [],
            numeroTelefono : '',
            indirizzo : '',
            indirizzoMail : '',
            nomeCognome : '',
            backToHome : false
        }
    },
    methods: {
        hiddenCart: function() {
            this.flag_cart = false;
        },
        
        amountFunction: function() {
            // conut amount
            var inputs = document.getElementsByClassName('quantity');
            // console.log(inputs[0].value);
            var quantities = new Array(inputs.length).fill(0);

            var textPrices = document.getElementsByClassName('price');
            var prices = [];

            var amount = 0;

            for (let index = 0; index < inputs.length; index++) {
                quantities[index] = parseInt(inputs[index].value);
                prices[index] = parseFloat(textPrices[index].childNodes[0].textContent);
                amount += quantities[index] * prices[index];
            }
            amount = parseFloat(amount.toFixed(2))
            this.amount = amount;

            // count quantity
            var names = document.getElementsByClassName("name_dish");

            var tmp_quantity = [];
            var tmp_names = [];
            for (let index = 0; index < inputs.length; index++) {
                quantities[index] = parseInt(inputs[index].value);
                tmp_quantity[index] = quantities[index];
                tmp_names[index] =names[index].childNodes[0].textContent;
            }
            // console.log(tmp_quantity);
            this.names_dish = tmp_names;
            this.quantity_dish = tmp_quantity;
        },
        payment: function(event) {
            // console.log(event);

            document.getElementById('ordine').click();


        },
        addToCart($value){
            document.getElementById('quantity' + $value).value ++;
            this.amountFunction();
        },
        decrementCart($value){
            let ref = document.getElementById('quantity' + $value).value;
            if(ref > 0) {
                document.getElementById('quantity' + $value).value --;
                this.amountFunction();
            }
        },
        // resetCart(value){
        //     console.log(value);
        //     for(let i = 0; i < value; i++) {
        //         console.log(i);
        //         document.getElementsByClassName('quantity')[i].value = 0;
        //         this.quantity_dish = [];
        //         this.amountFunction();
        //     }
            
        //},
        getRestaurants(category) {
            parameter = category.id;
            // console.log(parameter);
            var restaurantApi = 'api/guests/restaurants/' + parameter;
            axios.get(restaurantApi)
            .then(result => {
            // console.log(result);
            this.selected_category = category.name;
            this.restaurants = result.data.results.response
            this.flag = true;
            });
        },
        searchResults() {
            filter = this.searchFilter.toLowerCase();
            //console.log(filter);
            newResults = [];
            if (filter != '') {
                this.restaurants.forEach(element => {
                    //console.log(element);
                    let nFix = element.slug.replace('-', ' ');
                    //console.log(nFix);
                    if(nFix.includes(filter)) {
                        newResults.push(element);
                    }
                });
                this.collection = newResults;
                this.flag = false;
                this.searchFilter = '';
            }            
        },
        resetRestaurants() {
            this.collection = this.restaurants
            this.flag = true;
        },
    }
});


