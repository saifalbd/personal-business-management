/*
ay file copy hobe to public folder and metro js er upore hobe
 */


/*
$(document).ready(function(){


setTimeout(()=>{


charms.close();


},2000)



})

*/


const numberAdder = (data,withNumber=true)=>{
const requestForm = $('#requestForm');
const getId = function($finder){ return requestForm.find(`[name="${$finder}"]`);}
let type = getId('type');
let number = getId('number');
let number_confirm = getId('number_confirmation');
let amount = getId('amount');
let amount_confirm = getId('amount_confirmation');
let senderNumber = getId('senderNumber');
let senderName = getId('senderName');
if (withNumber) {
number.val(data.number)
number_confirm.val(data.number)
}

type.val(data.type)
senderName.val(data.name)
senderNumber.val(data.phone)


}



const tableAdd =(data,tableIs,charms=false)=>{
const charmsID = "#specific-charms";
const isOpen =  $("#specific-charms").hasClass('open');
if (charms) {
Metro.charms.open(charmsID);
 }else{
 $(charmsID).data('charms').close();

 }
   
data.forEach((item,index)=>{
var row2 = tableIs.insertRow(0);
var cell21 = row2.insertCell(0);
var cell22 = row2.insertCell(1);
var cell23 = row2.insertCell(2);
cell22.setAttribute("colspan", "2");
cell23.setAttribute("colspan", "2");
cell22.setAttribute("class", "text-center");
cell23.setAttribute("class", "text-center");
cell22.innerHTML = `<button class="button primary mini rounded js-dialog-close">Clone With Number</button>`;
cell23.innerHTML = `<button class="button primary mini rounded js-dialog-close">Clone WithOut Number</button>`;

cell22.addEventListener('click',()=>{numberAdder(item)})
cell23.addEventListener('click',()=>{numberAdder(item,false)})



var row = tableIs.insertRow(0);
var cell1 = row.insertCell(0);
var cell2 = row.insertCell(1);
var cell3 = row.insertCell(2);
var cell4 = row.insertCell(3);
var cell5 = row.insertCell(4);
cell3.setAttribute("data-role", "hint");
cell3.setAttribute("data-hint-text", item.city);
cell1.innerHTML = index+1;
cell2.innerHTML = item.number;
cell3.innerHTML = item.name;
cell4.innerHTML = item.phone;
cell5.innerHTML = item.counts;

})

}
// end tableAdd







$(document).ready(function(e) {
/*start input on finder */
 const table = document.getElementById('numberFinderTable');






const rlnth = $('#requestNumberLentgh');
$('#requestNumber').keyup(function(e) {
if (e.code=='KeyZ') {openNumberDialog()}
let inputVal = $(this).val();
if (inputVal.length) {rlnth.text(inputVal.length) }else{ rlnth.text('') }
if (inputVal.length>2) {
axios.get(`/api/order/${inputVal}/show`).then(res=>{
table.innerHTML = ''
if (res && res.data && res.data.length) {tableAdd(res.data,table,true);}
}).catch(e=>{console.error(e)})
}//
})










$('#senderName').keyup(function(e) {
let inputVal = $(this).val();
if (inputVal.length>2) {
axios.get(`/api/customer/search`,{
    params: {
      field: inputVal,
      type:'name'
    }
  }).then(res=>{
table.innerHTML = ''
if (res && res.data && res.data.length) {tableAdd(res.data,table,true);}
}).catch(e=>{console.error(e)})
}//
})




$('#senderNumber').keyup(function(e) {
let inputVal = $(this).val();
if (inputVal.length>2) {
axios.get(`/api/customer/search`,{
    params: {
      field: inputVal,
      type:'phone'
    }
  }).then(res=>{
table.innerHTML = ''
if (res && res.data && res.data.length) {tableAdd(res.data,table,true);}
}).catch(e=>{console.error(e)})
}//
})

/*end input on finder */
$('.btn-close').click(()=>{$('.model-container').hide()})




$('#advanceOpen').click(function(){

$(this).children('span').toggleClass('mif-plus mif-minus')
$('#advanceBox').slideToggle("slow");
})


    /*
    start showRate-btn
     */

    $("#showRate-btn").click(function () {

        Metro.charms.open('#charms-right');
    });
    /*
    end start showRate-btn
     */


})





/*start confrim number*/
function requestConfrimOpen(){


$('.model-container').css('display','flex');

const getId = (finder)=>{ return $('#requestForm').find(`[name="${finder}"]`);}
let type = getId('type');
let vendor = getId('vendor');

let number = getId('number');
let number_confirm = getId('number_confirmation');
let amount = getId('amount');
let amount_confirm = getId('amount_confirmation');
let senderNumber = getId('senderNumber');
let senderName = getId('senderName');
let chargeChack = getId('chargeChack');
let comment = getId('comment');
let customerBill = getId('customerBill');

var amountVal,amount_confirmVal;
if (chargeChack.prop( "checked" )) {
amountVal = parseInt(amount.val());
amountVal += Math.ceil(amountVal*0.02);
amount_confirmVal = parseInt(amount_confirm.val());
amount_confirmVal += Math.ceil(amount_confirmVal*0.02);
}else{
amountVal = amount.val();
amount_confirmVal = amount_confirm.val();
}

const getIdConf = (finder)=>{ return $('#requestFormConrim').find(`[name="${finder}"]`);}
let typeC = getIdConf('type');
typeC.val(type.val())
let vendorC = getIdConf('vendor');


vendorC.val(vendor.val())
let numberC = getIdConf('number');
numberC.val(number.val())
let number_confirmc = getIdConf('number_confirmation');

number_confirmc.val(number_confirm.val())
let amountC = getIdConf('amount');
amountC.val(amountVal)
let amount_confirmC = getIdConf('amount_confirmation');
amount_confirmC.val(amount_confirmVal)
let senderNumberC = getIdConf('senderNumber');
senderNumberC.val(senderNumber.val())
let senderNameC = getIdConf('senderName');
senderNameC.val(senderName.val())
let customerBillC = getIdConf('customerBill');
customerBillC.val(customerBill.val())

let commentC = getIdConf('comment');
commentC.val(comment.val())

let senderNameTxt = $(`[data-text="senderName"]`);
senderNameTxt.text(senderName.val())
let senderNumberTxt = $(`[data-text="senderNumber"]`);
senderNumberTxt.text(senderNumber.val())
let vendorTxt = $(`[data-text="vendor"]`);
vendorTxt.text($(`#requestForm [name="vendor"] option:selected`).text())
let numberTxt = $(`[data-text="number"]`);
numberTxt.text(number.val())
let amountTxt = $(`[data-text="amount"]`);
amountTxt.text(amountVal);





}



$(document).ready(function () {
    $(saif.convertRates.clickSelector).click(function(){saif.convertRates.init(this)});


    $(saif.showRates.clickSelector).click( function () {
        //const customerNumber = '50827627';

        saif.showRates.init(this);

    });
    $("#closeRate-btn").click(function () {
        saif.showRates.charmsClose("#showRate-btn");
    });


    /*
    end start showRate-btn
     */
});

/*end confrim number*/



var numberFunOpen = [
 {
            html: "<span class='mif-zoom-in'></span>",
            cls: "primary",
           onclick: "openNumberDialog()"
        },
]



var numberConfFunOpen = [
 {
            html: "<span class='mif-zoom-in'></span>",
            cls: "primary",
           onclick: "openNumberDialog('numConfrim')"
        },

]

