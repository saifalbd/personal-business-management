<template>
    <div class="row pt-2 pb-2">
        <!--number input-->
        <div class="cell-md-6">
            <div class="own-input-box" :class="numStatusClass">
                <div class="own-label">
                    <div class="label">
                        Request Number
                    </div>
                    <div class="own-button-group">
                        <button type="button" class="button mini" @click="openZoom('number')">
                            <span class="icon mif-zoom-in"></span>
                        </button>
                        <div class="own-counter">
                            <span class="txt">count</span>
                            <span class="val">
                        {{number.length}}
                    </span>
                        </div>
                    </div>
                </div>
                <input type="text" class="own-input big" v-model="number"

                >
                <div class="own-info-box">
                    {{numberStatus}}
                </div>
            </div>
        </div>
<!--number input end-->
        <!--number input-->
        <div class="cell-md-6">
            <div class="own-input-box" :class="numConStatusClass">
                <div class="own-label">
                    <div class="label">
                        Number Confirm
                    </div>
                    <div class="own-button-group">
                        <button type="button" class="button mini" @click="openZoom('confirm')">
                            <span class="icon mif-zoom-in"></span>
                        </button>
                        <div class="own-counter">
                            <span class="txt">count</span>
                            <span class="val">
                        {{numberConfirm.length}}
                    </span>
                        </div>
                    </div>
                </div>
                <input type="text" class="own-input big" v-model="numberConfirm"

                >
                <div class="own-info-box">
                    {{numberConStatus}}
                </div>
            </div>
        </div>
        <!--number input end-->





        <div v-if="overlay" class="overlay" style="background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center;
        align-items: center">
            <div class="dialog" style="max-width: 800px;">
                <div class="dialog-content">
                <div class="grid" id="zoomNumberGrid">
                    <div class="row">
                <div class="cell-md-12 number-confirm-cell"></div>
                <div class="cell-md-12 number-zoom-cell">
                    <p class="clear">
                        <span class="place-left">Request Number</span>
                        <span class="place-right zoomCount"></span>
                    </p>

                    <div class="input">
                    <input type="number" v-model="zoomNumber" autofocus="" :placeholder="zoomPlaceHolder"
                           id="ZoomNumber">
                </div>
                </div>
                        <div class="cell-md-12 null">

                              </div></div></div>
                              </div>

                            <div class="dialog-actions text-right">
                <div  class="button zommer-button primary">zoom in</div>
                <button type="button" @click="overlay=false" class="button js-dialog-close alert">Close</button></div>
                <span class="button square closer js-dialog-close"></span>
            </div>
        </div>

    </div>
</template>

<script>
    export default {

        props:{
          comingNumber:{type:String}
        },

        data(){
            return{
                overlay:false,
                zoomType:null,
                number:'',
                numberConfirm:'',
                zoomNumber:'',
                zoomPlaceHolder:null,
                numberConStatus:null,
                numberStatus:null,
                numConStatusClass:null,
                numStatusClass:null
            }
        },
        name: "numberInput",
        computed:{

        },
        methods:{
            openZoom(type){
                if (type==='number') {
                    this.zoomNumber = this.number;
                    this.zoomPlaceHolder = 'number'
                }else if (type==='confirm'){
                    this.zoomNumber = this.numberConfirm;
                    this.zoomPlaceHolder = 'number Confirm'
                }

                this.zoomType = type;
              this.overlay = true;
            },
            bothSame(){
                if (this.number ===this.numberConfirm){
                    this.numStatusClass = 'success';
                    this.numberStatus ='number and confirm both are same'
                    this.numConStatusClass = 'success';
                    this.numberConStatus ='number and confirm both are same'

                }
            },
            checkNumber: function () {

                this.numberStatus=null;
                this.numStatusClass=null;

                if (this.number){

                   if (parseInt(this.number[0])!==0){
                       this.numberStatus = 'number start must be 0';
                       this.numStatusClass = 'error';
                   }
                    if (this.number[1] && parseInt(this.number[1])!==1){
                        this.numberStatus = 'number start must be 01';
                        this.numStatusClass = 'error';
                    }

                if (this.number.length ===11) {
                    this.numberStatus = 'fill up number';
                    this.numStatusClass = 'success'
                }
                if (this.number.length<1 || this.number.length>11) {
                    this.numberStatus = 'number digit allow length 11';
                    this.numStatusClass = 'error';
                }



                if (this.numberConfirm && this.numberConfirm.length >2){
                    const con = this.numberConfirm;
                    if (this.number!==con) {

                        this.numberStatus = 'number and confirm number not Match';
                        this.numStatusClass = 'error';
                    }
                    this.bothSame();
                }

                }else{
                    this.numberStatus=null;
                    this.numStatusClass=null;
                }



            },
            checkNumberCon: function () {

                this.numConStatusClass=null;
                this.numberConStatus=null;


                if (this.numberConfirm) {


                if (parseInt(this.numberConfirm[0])!==0){
                    this.numberConStatus = 'number start must be 0';
                    this.numConStatusClass = 'error';
                }
                if (this.numberConfirm[1] && parseInt(this.numberConfirm[1])!==1){
                    this.numberConStatus = 'number start must be 01';
                    this.numConStatusClass = 'error';
                }

                if (this.numberConfirm.length ===11) {
                    this.numberConStatus = 'fill up number';
                    this.numConStatusClass = 'success'
                }
                if (this.numberConfirm.length<1 || this.numberConfirm.length>11) {
                    this.numberConStatus = 'number digit allow length 11';
                    this.numConStatusClass = 'error';
                }
                if (this.number && this.number.length >2){
                    const number = this.number;
                    if (this.numberConfirm!==number) {

                        this.numberConStatus = 'number and confirm number not Match';
                        this.numConStatusClass = 'error';
                    }
                    this.bothSame();
                }

                }else{
                    this.numConStatusClass=null;
                    this.numberConStatus=null;


                }



            },
        },
        watch: {
            number: function (val) {

                this.checkNumber();
                this.$emit('number', val);
            },
            numberConfirm: function (val) {

                this.checkNumberCon()
                this.$emit('numberConfirm', val);
            },
            zoomNumber:function (val) {
                if (this.zoomType){
                    if (this.zoomType==='number') {
                        this.number = val;
                    }else if (this.zoomType==='confirm') {
                        this.numberConfirm = val;
                    }
                }
            },
            comingNumber(val){
                //console.log('com',val)
                if (val) {
                   this.number = val;
                   this.numberConfirm = val;
                   this.overlay = false;
                }
            }


    },
        mounted() {
            this.$emit('numberConfirm', this.numberConfirm);
            this.$emit('number', this.number);
        }
    }
</script>

<style scoped>

</style>
