window.Vue = require('vue');

const orderMake = require('./components/order-make.vue').default;
const leftBar = require('./components/left-bar.vue').default;
const ShowRates = require('./components/ShowRates.vue').default;
const ShowFinder = require('./components/ShowFinder.vue').default;

Vue.component('order-make',orderMake);
Vue.component('left-bar',leftBar);
Vue.component('show-rates',ShowRates);
Vue.component('show-finder',ShowFinder);





var app = new Vue({
    el: '#app',
    data: {
      showRate:false,
      showFinder:false,
      pushFindigItem:{}

    },
    methods:{
findingItem(val){
this.pushFindigItem = val;
this.showFinder = false;
},
      showConvert(){

      },
        billUpdate(id,event){
            const  self = this;
            saif.billUpdate.init(id,function ($bill) {
                event.target.innerHTML = self.$options.filters.withSymbol($bill,'localSymbol');
            });
        }
    },
    mounted: function () {
        Metro.init();

    },
    filters: {
        withSymbol: function (value,symbol) {
            return value+' '+currency[symbol];
        }
    }
})
