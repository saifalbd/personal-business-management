<template>
    <div class="own-input-box " :class="statusClass">
        <div class="own-label">
            <div class="label">
                Phone
            </div>
            <div class="own-button-group">
               
                <div class="own-counter">
                    <span class="txt">count</span>
                    <span class="val">{{phone.length}}</span>
                </div>
            </div>
        </div>
        <input type="text" class="own-input" v-model="phone">
        <div class="own-info-box">
            {{status}}
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            comingPhone:{type:String}
        },

        data(){
            return{
                phone:'',
                status:null,
                statusClass:null
            }
        },
        name: "customerPhoneInput",
        methods:{
            checkPhone(){
                this.status = null;
                this.statusClass = null;
                if (this.phone){
                    if (parseInt(this.phone[0])===0){
                        this.status = 'invalid phone Number';
                        this.statusClass = 'error';
                    }else if (this.phone.length ===8) {
                        this.status  = 'fill up Phone number';
                        this.statusClass  = 'success'
                    }

                }else {
                    this.status = 'phone is Required';
                    this.statusClass = 'error';
                }

            }
            
        },
        watch:{
            phone:function (val) {
                this.checkPhone();
                this.$emit('phone',val)
            },
            comingPhone(val){

                if (val) {
                    this.phone= val;
                }
            }
        }
    }
</script>

<style scoped>

</style>