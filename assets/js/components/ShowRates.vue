<template>
  <div class="showRate">
    <div class="row">

      <div class="cell-md-12">
    </div>
    <table class="table table-border row-border cell-border row-hover"
 custom-sortable="true"
    >
     <thead>
     <tr class="filterTr">

       <td colspan="3"><input
          data-find="fromRateSelect"
          v-model="fromRate"
           type="text" data-role="input" data-prepend="From Rate: "></td>
       <td colspan="3"><input data-find="toRateSelect"
           v-model="toRate"
          type="text" data-role="input" data-prepend="To Rate: "></td>
     </tr>

     <tr class="titleTr sortable-tr">
         <th class="sortable-column">#</th>
         <th class="sortable-column">from Rate</th>
         <th class="sortable-column">To Rate</th>
         <th class="sortable-column">with Charge</th>
         <th class="sortable-column">Fee</th>
         <th class="sortable-column">CustomerRate</th>

     </tr>
     </thead>

        <tr v-if="!filteredRates[0]">
            <td colspan="6" class="text-center" >
                data not found
            </td>
        </tr>

  <tr v-for="(list,index) in   filteredRates" :keys="index">
       <td v-text="index+1"></td>
       <td v-text="list.localRate"></td>
       <td v-text="list.foreignMoney"></td>
       <td v-text="list.foreignWithFee"></td>
       <td v-text="list.fee"></td>
       <td v-text="list.exRate"></td>
     </tr>



     <tbody>

     </tbody>
 </table>
 </div>
  </div>
</template>

<script>
import axios from './../axios'
    export default {
        props:{
            data: Object,
        },
        data(){
          return {
            filteredRates:[],
            rates:[],
            fromRate:'',
            toRate:''
          }
        },
        computed:{

        },
        methods:{
        async  getRates(){
            try {
              const {data} = await  axios.get('/api/rates/rate');
              this.rates = data
              this.filteredRates = data;
            } catch (e) {
              console.log(e);
            }
          }
        },
        watch:{
            fromRate(val){
            let valis =    new RegExp(val)
this.filteredRates = this.rates.filter(item=>  valis.test(item.localRate) )
},
          toRate(val){
            let valis =    new RegExp(val)
this.filteredRates = this.rates.filter(item=>  valis.test(item.foreignMoney) )
            }
        },
        mounted() {
          this.getRates()
      }
    }
</script>
