<template>
    <div class="own-input-box ">
        <div class="own-label">
            <div class="label">
                Request Number
            </div>
            <div class="own-button-group">
                <button class="button mini">
                    <span class="icon mif-zoom-in"></span>
                </button>
                <div class="own-counter">
                    <span class="txt">count</span>
                    <span class="val">0</span>
                </div>
            </div>
        </div>
        <input type="text" class="own-input" v-model="number"

        >
        <div class="own-info-box">

        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                number:'0171s'
            }
        },
        name: "amountConfirmInput"
    }
</script>

<style scoped>

</style>