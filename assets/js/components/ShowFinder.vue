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
          v-model="name"
           type="text" data-role="input" data-prepend="By Name: "></td>
       <td colspan="3"><input
           v-model="phone"
          type="text" data-role="input" data-prepend="By Number: "></td>
     </tr>

     <tr class="titleTr sortable-tr">
         <th class="sortable-column">#</th>
         <th class="sortable-column">name</th>
         <th class="sortable-column">Number</th>
         <th class="sortable-column">Phone</th>
         <th class="sortable-column">Push</th>


     </tr>
   </thead style="font-size:22px;">

        <tr v-if="!filteredData[0]">
            <td colspan="6" class="text-center" >
                data not found
            </td>
        </tr>

  <tr v-for="(list,index) in   filteredData" :keys="index">
       <td v-text="index+1"></td>
       <td v-text="list.name"></td>
       <td v-text="list.number"></td>
       <td v-text="list.phone"></td>
       <td class="text-center">
           <button @click="pushItems(index)" type="button" class="button mini">push</button>
       </td>

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
            filteredData:[],
            initialData:[],
            name:'',
          phone:'',
          urlRole:'name'
          }
        },
        computed:{

        },
        methods:{
        async  getFindingResult(val){
            try {
              const {data} = await axios.get(`/api/customer/${val}/order-by-${this.urlRole}`);
              this.initialData = data
              this.filteredData = data;
            } catch (e) {
              console.log(e);
            }
          },
          doFilter(type,val){
            this.urlRole = type
          let valis =    new RegExp(val);
let filterd  = this.initialData.filter(item=>  valis.test(item[type]) )
if (!filterd.length) {
  this.getFindingResult(val)
   this.filteredData= this.initialData;
}else{
  this.filteredData = filterd;
}


},
pushItems(key){
  this.$emit('findingitem',this.filteredData[key])
}
        },
        watch:{
            name(val){
this.doFilter('name',val)
},
          phone(val){
            this.doFilter('phone',val)
            }
        },
        mounted() {

      }
    }
</script>
