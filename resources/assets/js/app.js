import { METHODS } from 'http';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('login',require('./components/LoginComponent.vue'));

const app = new Vue({
    el: '#app'
});

var mygooderusers = new Vue ({
    el: '#mygooderusers',
    data: {
        searchInUsers: '',
        tableColumns: ['id', 'name', 'email', 'created_at', 'updated_at'],
        tableData: []
    },
    created: function () {
      axios.get('/api/userscollection')
      .then(response => {
            this.tableData = response.data
            // console.log(this.tableData.data.length);
        })
        .catch(error => {
            console.log(error)
        });
  },
    computed: {
        nbFilteredData(){
            const filterKey = this.searchInUsers && this.searchInUsers.toLowerCase();
            let data = this.tableData.data;
            if (filterKey) {
                data = data.filter(function (row) {
                    return Object.keys(row).some(function (key) {
                        return String(row[key]).toLowerCase().indexOf(filterKey) > -1
                    });
                });
            }
            return data.length;
        }
    }
});

Vue.component('users', require('./components/UsersTableComponent.vue'));
Vue.component('userline', require('./components/UserLineComponent.vue'));
