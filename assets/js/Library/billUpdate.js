saif.billUpdate = {
    _uid:null,
init:function (payment_id,callback=null) {

        this.runAlert(payment_id,callback);
},
    update:async function(obj){
        try {
            axios.create({
                headers: {'common':{Accept:'application/json'}}
            });

            const formData = new FormData();

            formData.append('paymentId', parseInt(obj.paymentId));
            formData.append('oldBill', parseInt(obj.oldBill));
            formData.append('newBill', parseInt(obj.newBill));
            console.log(obj)
            const {data} =await axios.post(`/api/order/bill-update`,formData  );
            console.log(data);

            return  data;
        }catch (e) {
           console.error(e);
           return  e;
        }
    },
    runAlert:async function (payment_id,callback) {
        const self = this;
        Swal.mixin({
            input: 'number',
            inputAttributes: {
                autocapitalize: 'off',
                required:'true'
            },
            confirmButtonText: 'Next &rarr;',
            showCancelButton: true,
            progressSteps: ['1', '2', '3']
        }).queue([
            {
                title: 'Payment Id',
                text: 'put Payment id for Update Your Current Bill'
            },
            {
                title: 'Current Bill',
                text: 'Update Your Current Bill'
            },
            {
                title: 'New Bill',
                text: 'Update Your Current Bill'
            },

        ]).then(async (result)   => {
            try {
            const paymentId= parseInt(result.value[0]);
            const oldBill= parseInt(result.value[1]);
            const newBill= parseInt(result.value[2]);


            if (paymentId!==payment_id){
                saif.notifyAlert.errorMessage('click id and put payment id not are same');
            }
            const data = await self.update({paymentId,oldBill,newBill});
            if (typeof callback === 'function') {
                callback(newBill);
            }

                if (result.value) {
                    saif.notifyAlert.updateMessage(data.updated);
                }
            }catch (e) {
               console.error(e)
            }


        })
    }
};