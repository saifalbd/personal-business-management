<template>

    <div style="
    background:whitesmoke;
     min-width: 150px;
      position:fixed;
       left: 0;
       top: 0px;
       z-index: 10000;
"
    v-if="tdItems.length">
        <table class="table row-hover row-border cell-border compact" v-bind:style="{ backgroundColor: bg }">

            <thead>
            <tr>
                <td class="text-center" colspan="5">
                    <button @click="reset" type="button" class="button light mini" id="closeRate-btn">close Rate</button>
                </td>
            </tr>
            <tr class="titleTr">
                <th v-if="tableHeader.number">number</th>
                <th v-if="tableHeader.name">name</th>
                <th v-if="tableHeader.phone">phone</th>
                <th v-if="tableHeader.times">times</th>
            </tr>
            </thead>
            <tbody>
          <template v-for="(item,index) in tdItems" >
              <tr :key="index">
                  <td v-if="item.number">{{item.number}}</td>
                  <td>{{item.name}}</td>
                  <td>{{item.phone}}</td>
                  <td v-if="item.counts">{{item.counts}}</td>
              <tr>
                  <td colspan="4" class="text-center">
                      <button @click="pushItems(index)" type="button" class="button mini">push</button>
                  </td>

              </tr>

          </template>


            </tbody>
        </table>
    </div>
    
</template>

<script>
    import collect from 'collect.js'
    import axios from './../axios'
    export default {
        name: "left-bar",

        props:{
          listData:{
              type:Object,
              require:true,
          }
        },

        data(){
            return {
                tdItems:[]
            }
        },
        computed:{
            tableHeader(){
                const arr = {number:'number',name:'name',phone:'phone',times:'times'}
                if (this.listData.type=== 'name' || this.listData.type=== 'phone'){
                    delete arr['number'];
                    delete arr['times'];
                }
                return arr;
            },
            bg(){
               const {type}= this.listData;
               if (type ==='number'){
                   return `#1d0029`;
               } else if(type ==='name'){
                   return `#000000`;
               }else if (type ==='phone') {
                   return `#100127`;
               }else {
                   return `red`;
               }
            },
            url(){
                if (this.listData && this.listData.val){
                   let {type,val}  = this.listData;
                   if (type==='number'){
                       return  `/api/order/${val}/show`
                   }else if (type==='name'){
                       return  `api/customer/${val}/search-by-name`
                   }else if (type==='phone') {
                       return  `api/customer/${val}/search-by-phone`
                   }else {
                       throw  new Error('listData.type only allow  number,name,phone')

                   }
                }else{
                    return false;
                }
            }
        },
        methods:{
            reset(){
                this.tdItems = [];
            },
            checkCollection(data){


                var patt = new RegExp(this.listData.val);
                 let collection =  collect(data).filter(item=>patt.test(item[this.listData.type])).all()


                return collection;

            },
            async  findNumber(){

           try {
               const  {data} = await axios.get(this.url)
               this.tdItems = this.checkCollection(data)

           }catch (e) {

               if (e.response===204) {
                   this.reset();
                   console.log(e.response.statusText)
               }else {
                   console.error(e)
               }

            console.log(e)
           }

            },
            async findName(){
                let url = this.url;
                try {
                    const  {data} = await axios.get(url)
                    console.log(data)
                    //this.tdItems = this.checkCollection(data)

                }catch (e) {

                    if (e.response===204) {
                        this.tdItems = [];
                        console.log(e.response.statusText)
                    }else {
                        console.error(e)
                    }

                    console.log(e)
                }

            },
            pushItems(index){
                this.$emit('orderList',this.tdItems[index])
                this.reset()
      }

        },
        watch:{
            url(newVal,oldVal)  {


              if (newVal) {
                  console.log(newVal,oldVal)
                  if (newVal.length !==oldVal.length) {
                      let isHave = this.checkCollection(this.tdItems);
                      if (isHave.lentgh) {
                          this.tdItems = isHave;
                      }else{
                          this.findNumber();
                      }
                      //
                  }else {
                      this.reset()
                  }
              }




          }
        },
        mounted() {





        }

    }
</script>

<style scoped>

</style>