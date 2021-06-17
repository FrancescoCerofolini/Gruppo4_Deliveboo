/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: axios } = require('axios');
const { includes } = require('lodash');

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
        var categoryApi = 'api/guests/dishes_categories';
        axios.get(categoryApi)
        .then(result => {
            console.log(result);
            this.categories = result.data.results;
            console.log(this.categories);
        });
    },
    data() {
        return {
            url: 'https://payments.sandbox.braintree-api.com/graphql',
            payment_status: '',
            boolean: false,
            restaurants : '',
            collection : '',
            categories : false,
            selected_category : '',
            searchFilter : '',
            flag : false,
        }
    },
    methods: {
        payment: function(event) {
            console.log(event);

            axios({
                method: 'post',
                url: this.url,
                headers: {
                    'Authorization': 'Basic aHJydnM3ZHBnaGRxaDZ4OTo2ODA3NTc0MjFmMzM4MDgxNTFhYmY2YmZiZTkxNmVhNw==',
                    'Braintree-Version': '2021-06-09',
                    'Content-Type': 'application/json'
                },
                data: {
                    'query': 'mutation chargePaymentMethod($input: ChargePaymentMethodInput!) { chargePaymentMethod(input: $input) { transaction { id status } } }',
                    'variables': {
                        'input': {
                        'paymentMethodId': 'fake-valid-mastercard-nonce',
                        'transaction': {
                            'amount': '1.00'
                        }
                    }
                    }
                }
            })
            .then(response => {
                console.log(response);
                this.payment_status = response.data.data.chargePaymentMethod.transaction.status;

                //if (this.payment_status == 'SUBMITTED_FOR_SETTLEMENT') {
                    //this.boolean = true;
                    document.getElementById('status').value = this.payment_status;
                    document.getElementById('tiodio').click();
                //}
                console.log(this.payment_status);

            });


        },
        getRestaurants(category) {
            parameter = category.id;
            console.log(parameter);
            var restaurantApi = 'api/guests/restaurants/' + parameter;
            axios.get(restaurantApi)
            .then(result => {
            console.log(result);
            this.selected_category = category.name;
            this.restaurants = result.data.results.response
            this.flag = true;
            });
        },
        searchResults() {
            filter = this.searchFilter;
            console.log(filter);
            newResults = [];
            this.restaurants.forEach(element => {
                console.log(element);
                if(element.slug.includes(filter)) {
                    newResults.push(element);
                }
            });
            this.collection = newResults;
            this.flag = false;
            this.searchFilter = '';
        },
        resetRestaurants() {
            this.collection = this.restaurants
        },
    }
});


