<template>


    <form class="_requestForm" method="get" :action="action" accept-charset="UTF-8" id="vueOrderForm">

        <input  type="hidden" name="_token" :value="token">
        <input v-if="customerId" type="hidden" name="customerId" v-model="customerId">
        <input v-if="orderId" type="hidden" name="orderId" v-model="orderId">
        <input v-if="finalAmount" type="hidden" name="amount" v-model="finalAmount">
        <input v-if="bill" type="hidden" name="bill" v-model="bill">
        <input v-if="comment"  type="hidden" name="bill" v-model="comment">


        <!--start -->
        <div class="row pt-2 pb-2">
            <!--start cell-->
            <div class="cell-md-6">
                <div class="own-input-box">
                    <div class="own-label">
                        <div class="label">
                            Vendor
                        </div>

                    </div>
                    <select class="own-select" name="vendorId" v-model="vendor" v-if="doVendorSelected">
                        <option v-for="(option,index) in vendors"
                                v-bind:value="option.id" :key="index">
                            {{ option.name }}
                        </option>

                    </select>
                    <div class="own-info-box"></div>
                </div>
            </div>
            <!--end cell-->
            <!--start cell-->
            <div class="cell-md-6">
                <div class="own-input-box">
                    <div class="own-label">
                        <div class="label">
                            Type
                        </div>

                    </div>
                    <select  class="own-select" v-model="type">
                        <option v-for="(option,index) in options"
                                v-bind:value="option.value" :key="index">
                            {{ option.text }}
                        </option>
                    </select>
                    <div class="own-info-box">

                    </div>
                </div>
            </div>
            <!--end cell-->
            <!--start cell-->
            <div class="cell-md-12">
                <number-input
                        @number ='getNumber'
                        @numberConfirm="getConfirmNumber"
                        :comingNumber = "coming.number"
                ></number-input>
            </div>
            <!--end cell-->
            <!--start cell-->
            <div class="cell-md-12">
                <amount-input
                        @addCharge="getDataCaption"
                        @amount="getAmount"
                        @amountConfirm="getConfirmAmount"></amount-input>
            </div>
            <!--end cell-->


            <!--start cell-->
            <div class="cell-md-6">
                <customer-name-input
                        :comingName="coming.name"
                        @customerName="getCustomerName"></customer-name-input>
            </div>
            <!--end cell-->
            <!--start cell-->
            <div class="cell-md-6">
                <customer-phone-input
                        :comingPhone="coming.phone"
                        @phone="getCustomerPhone"></customer-phone-input>
            </div>
            <!--end cell-->
            <!--start cell-->
            <div class="cell-md-12 text-center mt-3">
                <div class="own-submit-box">
                    <button type="button" @click="confirm"  class="button yellow">Confirm</button>

                </div>
            </div>
            <!--end cell-->

        </div>

        <div v-if="overlay" class="overlay confirmation-overly" style="background: rgba(0, 0, 0, 0.5); display: flex;
        justify-content:
        center;
        align-items: center; color: #000;">
            <div class="card" style="max-width: 600px">
                <div class="card-header d-flex flex-justify-between">
                    Order Confirmation
                    <button type="button" class="button mini" @click="isComment=isComment?false:true">
                        <span class="mif-pencil"></span>
                        add comment
                    </button>
                </div>
                <div class="card-content p-2">
                    <div class="grid">
                        <div class="row m-0">
                          <div class="cell-12 mt-1">
                              <div class="row">
                                  <div class="stub" style="min-width: 200px;">
                                      vendor
                                  </div>
                                  <div class="cell">
                                      {{getVendorName}}
                                  </div>
                              </div>
                          </div>
                           <div class="cell-12 mt-1">
                                <div class="row">
                                    <div class="stub" style="min-width: 200px;">
                                        TYPE
                                    </div>
                                    <div class="cell">
                                        {{type}}
                                    </div>
                                </div>
                            </div>
                            <div class="cell-12 mt-1">
                                <div class="row">
                                    <div class="stub" style="min-width: 200px;">
                                        Number
                                    </div>
                                    <div class="cell">
                                        {{number}}
                                    </div>
                                    <div class="cell-3 p-0" v-if="orderStatus">
                                        <div class="info-btn">
                                            {{orderStatus}}

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="cell-12 mt-1">
                                <div class="row">
                                    <div class="stub" style="min-width: 200px;">
                                        Amount
                                    </div>
                                    <div class="cell">
                                        {{finalAmount}}
                                    </div>
                                    <div class="cell-3 p-0">
                                        <div class="info-btn">
                                            {{dataCaption}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="cell-12 mt-1">
                                <div class="row">
                                    <div class="stub" style="min-width: 200px;">
                                        bill
                                    </div>
                                    <div class="cell input-cell">
                                        {{bill}}
                                        <div class="bill-input-box" v-if="isChangeBill">
                                            <input  class="bill-input" type="text" v-model="bill">
                                        </div>

                                    </div>
                                    <div class="cell-3 p-0">
                                        <div class="info-btn">
                                            <button type="button" class="button mini primary"
                                                    @click="isChangeBill=isChangeBill?false:true">
                                                {{isChangeBill?'hide change':'show Change'}}
                                            </button>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="cell-12 mt-1">
                                <div class="row">
                                    <div class="stub" style=" min-width: 200px;">
                                        Customer Name
                                    </div>
                                    <div class="cell">
                                        {{customerName}}
                                    </div>
                                </div>
                            </div>

                            <div class="cell-12 mt-1">
                                <div class="row">
                                    <div class="stub" style="min-width: 200px;">
                                        Customer Phone
                                    </div>
                                    <div class="cell">
                                        {{customerPhone}}
                                    </div>
                                    <div class="cell-3 p-0">
                                        <div class="info-btn">
                                            {{customerStatus}}

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="cell-12 mt-1" v-if="isComment">
                                <div class="row">
                                    <div class="stub" style=" min-width: 200px;">
                                        comment
                                    </div>
                                    <div class="cell input-cell">
                                        <div class="comment-input-box">
                                            <input   class="comment-input" type="text" v-model="comment">
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
                <div class="card-footer text-right">
                   <button  type="button" class="button alert" @click="overlay=false">
                       <span class="mif-cross"></span>
                       Close
                   </button>

                    <div   class="button success" @click="submitRequest">
                        <span class="mif-done_all"></span>
                        Submit
                    </div>
                </div>
            </div>
        </div>
        <left-bar  :listData="listData"  @orderList="comingItem"></left-bar>

    </form>

</template>

<script>

    const numberInput = require('../components/inputs/numberInput.vue').default;
    const numberInputConfirm = require('../components/inputs/numberInputConfirm.vue').default;
    const amountInput= require('../components/inputs/amountInput.vue').default;
    const customerNameInput= require('../components/inputs/customerNameInput.vue').default;
    const customerPhoneInput= require('../components/inputs/customerPhoneInput').default;

    export default {
        name: "order-make",
        components:{
            'number-input':numberInput,
           'number-input-confirm':numberInputConfirm,
           'amount-input':amountInput,
           'amount-input-confirm':amountInput,
            'customer-name-input':customerNameInput,
            'customer-phone-input':customerPhoneInput



        },
        props:{
            vendors:{
                required:true,
                type:Array

            },
            action:{
                required:true,
                type:String
            },
            token:{
                required:true,
                type:String
            },

          orderitem:{
type:Object
          }

        },
        data(){
            return{
                type:'personal',
                vendor:'',
                number:null,
                confirmNumber:null,
                orderId:null,
                amount:null,
                confirmAmount:null,
                finalAmount:null,
                bill:null,
                customerName:null,
                customerId:null,
                customerPhone:null,
                comment:null,
                overlay:false,
                dataCaption:null,
                customerStatus:null,
                orderStatus:null,
                isChangeBill:true,
                isComment:false,
                listData:{type:'number',val:null},
                options: [
                    { text: 'personal', value: 'personal' },
                    { text: 'agent', value: 'agent' },
                ],
                coming:{
                    number:null,
                    name:null,
                    phone:null
                }
            }

        },
        computed:{
            doVendorSelected(){
                if (this.vendors){
                    this.vendor=this.vendors[0].id;
                    return true;
                }

            },
            getVendorName(){
               const vendor =   this.vendors.filter((age)=> {
                    return age.id ===this.vendor;
                });
                return vendor[0]? vendor[0].name:null

            }
        },
        methods:{
            getNumber(value){this.number= value},
            getConfirmNumber(value){this.confirmNumber= value},
            getAmount(value){this.amount= value},
            getConfirmAmount(value){this.confirmAmount= value},
            getCustomerName(value){this.customerName= value},
            getCustomerPhone(value){this.customerPhone= value},

            getFinalAmount(){
                const amount = parseInt(this.amount);
                if (amount) {
                    this.finalAmount =amount+(amount*0.02)

                }else{
                    this.finalAmount = amount;
                }
                return this.finalAmount;
            },
            getDataCaption(value){

                this.dataCaption = value?'with Charge':'without Charge'
               this.getFinalAmount()

            },

            getOverlay(value){
                this.overlay = value;
            },

            async makeOrder(){
                try {
                    const formData = new FormData(); // Currently empty
                    formData.append('type',this.type);
                    formData.append('number',this.number)
                    const res =await axios.post('/api/order/store',formData);
                    this.orderId = res.data.id;
                    console.log('order',res.data)
                    this.orderStatus= 'created';
                    return  res;

                }catch (e) {

                    saif.notifyAlert.restFromErrorsMessage(e);
                    return  e;
                }



            },
            async makeCustomer(){
                try {
                    const formData = new FormData(); // Currently empty
                    formData.append('name',this.customerName);
                    formData.append('phone',this.customerPhone);
                    saif.loader.text('wait making Customer').openCycle();
                    const res =await axios.post('/api/customer/store',formData);

                    this.customerId = res.data.id;
                    this.customerStatus= 'created';
                    saif.loader.close();
                    return  res;



                }catch (e) {

                    saif.notifyAlert.restFromErrorsMessage(e);
                    return e;
                }

            },
           async getBill(){
               try {

               }catch (e) {

               }
            },
           async checkVerifiedUser(){

                try {

                    this.customerId = null;
                    this.orderId=null;
                    this.orderStatus=null;
                    this.bill = null;
                    const formData = new FormData(); // Currently empty
                    formData.append('phone',this.customerPhone);
                   formData.append('number',this.number);
                    formData.append('amount',this.getFinalAmount());

                    const res =await axios.post('/api/customer/get',formData);
                    if (res.status===200){
                        const {customer,order,bill}= res.data;
                        console.log('customer',res.data)
                        if (customer){
                            this.customerStatus = customer.status;
                            this.customerName = customer.name;
                            this.customerId = customer.id;
                        }
                        if (order){
                            this.orderStatus = order.status;
                            this.orderId=order.id;
                        }

                        if (bill){
                            this.bill= bill;
                        }

                    }else if (res.status===203) {
                        const {bill}= res.data;
                        if (bill){
                            this.bill= bill;
                        }
                        this.customerStatus = res.statusText;
                    }

                    console.log(res);

                    saif.loader.close()
                    this.getOverlay(true);
                }catch (e) {
                    saif.notifyAlert.restFromErrorsMessage(e)
                }
            },
            confirm(){
               try {

                   if (!this.type) throw 'type are required'
                   if (!this.vendor) throw 'vendor are required'
               if (!this.number) throw 'number are required'
                   if (!this.confirmNumber) throw 'confirmNumber are required'
                   if (this.number !==this.confirmNumber)  throw 'confirmNumber and number are not same'
                   if (!this.amount) throw 'amount are required'
                   if (!this.confirmAmount) throw 'confirmAmount are required'
                   if (this.amount !==this.confirmAmount)  throw 'confirmAmount and amount are not same'

                   if (!this.customerName) throw 'customerName are required'
                   if (!this.customerPhone) throw 'customerPhone are required';


                   saif.loader.openCycle();
                   this.checkVerifiedUser();

               }catch (e) {
                   saif.notifyAlert.errorMessage(e)
               }


            },
           async submitRequest(){
               var res= null;
               if (!this.customerId) {

                  res = await this.makeCustomer();
                  if (res.data){
                      console.log(res.data)
                      saif.loader.text('success FullY Created Customer').openMetro();
                  }



               }

                if (!this.orderId) {
                    saif.loader.close()
                    saif.loader.text('wait making Order').openSquare();

                      this.makeOrder().then((res)=>{
                          console.log(res)
                         saif.loader.close()
                         saif.loader.text('success FullY Created Order').openMetro();
                         setTimeout(()=>{
                             document.getElementById('vueOrderForm').submit();
                         },3000)


                     });





                }else{
                    saif.loader.text('wait for Submit').openSquare();
                    document.getElementById('vueOrderForm').submit();
                }

            },

            comingItem(val){

                this.coming = val;
            }

        },
        watch:{
            number(val){
               this.listData.type='number' ;
                this.listData.val = this.number;
            },
            customerName(val){
                this.listData.type='name' ;
                this.listData.val = this.customerName;
            },
            customerPhone(val){
                this.listData.type='phone' ;
                this.listData.val = this.customerPhone;
            },
            orderitem(val){
              if (val.number && val.phone && val.name) {
              this.coming = val;
              }
            }

        },
        mounted() {
            //this.getOverlay(true);
        }
    }
</script>

<style scoped>

</style>
