
  saif.Interval = function(){
    this.intervalIs = null;
    this.set=async function(fun,timeCycle) {
        await  this.fresh();
        this.intervalIs =  setInterval(fun, timeCycle);
        return this;
    };
    this.callBack= (resolve,reject)=> {

        if (this.intervalIs) {

            clearInterval(this.intervalIs);
            this.intervalIs = null;
            resolve(true);
        }else{
            resolve(true);
        }
    }
    this.fresh= function(){
        let x = this.callBack;

        return new Promise(x);
    };
    this.clear =async function () {
        await  this.fresh();
        this.intervalIs = null;
    }

}

  saif.convertRates = {
    getData:null,
    charmsHasShow:false,
    clickSelector:'#showConvert-btn',
    charmsSelector:'#charms-bottom',
    submitSelector:'#convertSubmit',
    interval :new saif.Interval(),
    findByChange:function(){
        $('#findBy').change(function() {
            const value = $(this).val();
            var message;
            const  local = currency.localSymbol;
            const foreign = currency.foreignSymbol;
            if (value ==local){
                message = 'Type amount '+local+' money';
            }else if (value ==foreign){
                message = 'Type amount '+foreign+' money';
            }
            $('#rateAmount').next('.text-muted').text(message);
        })
    },


    submit:function(){
        $(this.submitSelector).click(async ()=>{

            // await  inter.fresh();
            await this.getBill();
            if (this.getData){

                const data = this.getData;
                // console.log(this.getData)
                const result = $('#convertResult')
                const terms = $('#convertTerms');

                var count = 0;
                var  balance;
                var endBal = data.amount;
                var increaseLimit = endBal/20;
                this.interval.set(frame,100);
                const self = this;
                function  frame() {
                    if (count < endBal) {
                        count+=increaseLimit;
                        balance = Math.round(count);
                    }
                    if(count > endBal) {
                        self.interval.clear();
                        //console.log(inter.value);
                        balance = endBal;
                        endBal = 0;
                        count= 0;
                        increaseLimit =0;

                    }
                    //console.log(balance);
                    result.text(balance+' '+data.amountType)
                }
//result.text(counter+' '+this.getData.amountType);
                terms.text(this.getData.terms);

            }

        });
    },
    startClick:function(){
        this.findByChange();
        this.submit();

    },
    charmsClose:function () {
        Metro.charms.close(this.charmsSelector);
        this.charmsHasShow = false;
        $(this.clickSelector).text('Show Convert');
    },
    charmsOpen:function () {

        Metro.charms.open('#charms-bottom');
        this.charmsHasShow = true;
        $(this.clickSelector).text('Hide Convert')
    },
    init:function (){

        if (this.charmsHasShow) {
            this.charmsClose()

        }else{

            this.charmsOpen()

        }

        this.startClick();
    },
    getValues:function () {
        const data = [];
        const findByID = $('#findBy');
        const valID =  $('#rateAmount');
        const findBy = findByID.val() ?  findByID.val() : false;
        if (findBy && (findBy==currency.localSymbol||findBy==currency.foreignSymbol)){
            data.type = findBy;
        }

        const valIs = valID.val() ? valID.val() : false;

        if (data.type && valIs) {

            data.val = valIs;}

        return data;
    },
    getBill:async function () {
        const getData = this.getValues();


        if (getData.hasOwnProperty('val')&& getData.hasOwnProperty('type')){
            const formData = new FormData();
            formData.append('type', getData.type);
            formData.append('val', getData.val);
            try {

                axios.create({
                    headers: {'common':{Accept:'application/json'}}
                });
                const res =await axios.post(`/api/rates/convert`,formData );
                this.getData = res.data;
                return  res.data;

            }catch (e) {
                console.error(e);
                return  e;
            }

        }else{
            alert('from value are missing');
            console.error('from value are missing ')
        }
    }

}
const showRates = {
    charmsHasShow:false,
    charmsSelector:"#charms-right",
    clickSelector:'#showRate-btn',
    table:function () {
        return  document.getElementById('rateFinderTable');
    },
    init:async function(){
        let items =  await showRates.getRates();
        this.makeTable(items,this.table());
        if (this.charmsHasShow){
            this.charmsClose()
        }else{
            this.charmsOpen()
        }
    },
    charmsOpen:function(){
        Metro.charms.open(this.charmsSelector);
        this.charmsHasShow = true;
        $(this.clickSelector).text('Hide Rates');
    },
    charmsClose:function(){
        Metro.charms.close(this.charmsSelector);
        this.charmsHasShow = false;
        $(this.clickSelector).text('show Rates');
    },
    makeTable:function (items,tableIs) {
        items.reverse().forEach((item,key)=>{

            var row2 = tableIs.insertRow(0);
            var cell21 = row2.insertCell(0);
            var cell22 = row2.insertCell(1);
            var cell23 = row2.insertCell(2);
            var cell24 = row2.insertCell(3);
            var cell25 = row2.insertCell(4);
            cell21.innerHTML = items.length-key;
            cell22.innerHTML = item.localRate;
            cell23.innerHTML = item.foreignMoney;
            cell24.innerHTML = item.foreignWithFee;
            cell25.innerHTML = item.exRate;
        })
    },
    getRates:async function (phone=null) {
        try {
            const {data} = await axios.get(`/api/rates/rate`);
            // console.log(data);
            return  data;
        }catch (e) {
            console.error(e);
            return  e;
        }

    }


}

