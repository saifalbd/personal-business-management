<template>
    <div class="own-input-box " :class="statusClass">
        <div class="own-label">
            <div class="label">
               Customer Name
            </div>

        </div>
        <input type="text" class="own-input" v-model="customerName"

        >
        <div class="own-info-box">
            {{status}}
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            comingName:{type:String}
        },
        data(){
            return{
                customerName:'',
                status:null,
                statusClass:null,
            }
        },
        name: "customerNameInput",
        methods:{
            checkName(){
                this.status = null;
                this.statusClass = null;
                const name = this.customerName;
                if (name) {
                    if (!isNaN(name)){
                        this.status  = 'its not valid name';
                        this.statusClass = 'error'
                    }

                }else {
                    this.status  = 'name is required';
                    this.statusClass = 'error'
                }

            }

        },
        watch:{
            customerName:function (val) {
                this.$emit('customerName',val);
                this.checkName()
            },
            comingName(val){
                //console.log('com',val)
                if (val) {
                    this.customerName = val;
                }
            }
        },
        mounted() {
            this.$emit('customerName',this.customerName);
        }
    }
</script>

<style scoped>

</style>