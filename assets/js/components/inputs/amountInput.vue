<template>
    <div class="row pt-2 pb-2">
        <!--amount input-->
        <div class="cell-md-6">
            <div class="own-input-box " :class="statusAmountClass">
                <div class="own-label">
                    <div class="label">
                        amount
                    </div>


                </div>
                <input type="text"  class="own-input mid" v-model="amount"

                >
                <div class="own-info-box">
                    {{statusAmount}}
                </div>
            </div>
        </div>
        <!--end amount input-->

        <!--amount input-->
        <div class="cell-md-6">
            <div class="own-input-box " :class="statusConAmountClass">
                <div class="own-label">
                    <div class="label">
                        amount Confirm
                    </div>

                </div>
                <input type="text"  class="own-input mid" v-model="amountConfirm"

                >
                <div class="own-info-box">
                    {{statusConAmount}}
                </div>
            </div>
        </div>
        <!--end amount input-->
        <div class="cell-md-6 offset-3 d-flex flex-align-center flex-justify-center"
             style="background: #01093a;
    border: 1px solid bisque;
    border-radius: 25px;">
            <input @change="checkChange" type="checkbox" data-role="checkbox" :data-caption="dataCaption">
        </div>
    </div>

</template>

<script>
    export default {

        data(){
            return{
                amount:null,
                amountConfirm:null,
                statusAmount:null,
                statusConAmount:null,
                statusAmountClass:null,
                statusConAmountClass:null,
                dataCaption:'without Charge',
                addCharge:false,
            }
        },
        name: "amountInput",
        methods:{
            bothSame(){
                if (this.amount ===this.amountConfirm){
                    this.statusAmountClass = 'success';
                    this.statusAmount ='amount and confirm both are same'
                    this.statusConAmountClass = 'success';
                    this.statusConAmount ='amount and confirm both are same'
                }
            },
            checkAmount(){
                this.statusAmount = null;
                this.statusAmountClass = null;
                if (this.amount){
                    if (isNaN(this.amount)){
                        this.statusAmountClass = 'error';
                        this.statusAmount ='amount only allow integer'
                    }
                    if (this.amountConfirm){
                        if (this.amount !==this.amountConfirm){
                            this.statusAmountClass = 'error';
                            this.statusAmount ='amount and confirm amount not same'
                        }
                      this.bothSame()
                    }
                }
            },
            checkConAmount(){
                this.statusConAmount= null;
                this.statusConAmountClass= null;

                if (this.amountConfirm){
                    if (isNaN(this.amountConfirm)){
                        this.statusConAmountClass = 'error';
                        this.statusConAmount ='amount only allow integer'
                    }
                    if (this.amountConfirm){
                        if (this.amount !==this.amountConfirm){
                            this.statusConAmountClass = 'error';
                            this.statusConAmount ='amount and confirm amount not same'
                        }
                        this.bothSame()
                    }
                }
            },
            checkChange(e){
                let el = e.target;
                if (el.checked){
                    this.dataCaption='with Charge'
                    this.addCharge = true
                }else {
                    this.dataCaption='without Charge'
                    this.addCharge = false
                }
                el.parentElement.querySelector('.caption').innerHTML = this.dataCaption;
            }
        },
        watch: {

            amount:function (val) {
                this.checkAmount();
                this.$emit('amount',val)
            },
            amountConfirm:function (val) {
                this.checkConAmount();
                this.$emit('amountConfirm',val)
            },
            dataCaption:function (val) {
                this.$emit('dataCaption',val);
            },
            addCharge:function (val) {
                this.$emit('addCharge',val);
            }
        },
        mounted() {
            this.$emit('amount',this.amount);
            this.$emit('amountConfirm',this.amountConfirm)
            this.$emit('dataCaption',this.dataCaption);
            this.$emit('addCharge',this.addCharge);
        }
    }
</script>

<style scoped>

</style>