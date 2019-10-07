
<div class="model-container">
<div class="window">
    <div class="window-caption">
        <span class="icon mif-windows"></span>
        <span class="title">Request Confrim</span>
        <div class="buttons">
           
            <span class="btn-max"></span>
            <span class="btn-close" ></span>
        </div>
    </div>
    <div class="window-content p-2">
     <div class="container" >





      <div class="row" >
        <div class="stub" style="width: 200px; background: black; color: white;">Customer Info</div>
        <div class="cell-md-11 offset-md-1">
          <div class="row mt-1">
            <div class="stub" style="width: 150px; background: lightgrey; color: black;">name:</div><div class="cell" data-text="senderName" style="background: black; color: white;"></div>
          </div>
          <div class="row mt-1">
            <div class="stub" style="width: 150px; background: lightgrey; color: black;">Phone:</div><div class="cell"  data-text="senderNumber" style="background: black; color: white;"></div>
          </div>
          <div class="row mt-1">
            <div class="stub" style="width: 150px; background: lightgrey; color: black;">Vendor:</div><div class="cell"  data-text="vendor" style="background: black; color: white;"></div>
          </div>

        </div>
      </div>


        <div class="row mt-3">
        <div class="stub" style="width: 200px; background: black; color: white;">Customer Info</div>
        <div class="cell-md-11 offset-md-1">
          <div class="row mt-1">
            <div class="stub" style="width: 150px; background: lightgrey; color: black;">name:</div><div class="cell" style="background: black; color: white;">
              <h1><strong   data-text="number" >
                01715045042
              </strong></h1>
            </div>
          </div>
          <div class="row mt-1">
            <div class="stub" style="width: 150px; background: lightgrey; color: black;">taka:</div><div class="cell-md-12" style="background: black; color: white;">
              <h1><strong  data-text="amount">
               2042
              </strong></h1>  
            </div>
           
          </div>

        </div>
        <div class="cell-md-12 mt-3 p-2 d-flex flex-justify-end" style="background: black; color: white;">
          <button class="button alert  large btn-close mr-2">Close</button>
       
  <form method="get" id="requestFormConrim" action="{{route('request.store')}}"
           accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input name="vendor" type="hidden" required>
            <input name="type" type="hidden" required>
            <input name="number" type="hidden" required>
            <input name="number_confirmation" type="hidden" required>
            <input name="amount" type="hidden" required>
            <input name="amount_confirmation" type="hidden" required>
            <input name="senderName" type="hidden" required>
            <input name="senderNumber" type="hidden" required>
            <input name="customerBill" type="hidden" required>
            <input name="comment" type="hidden" required>
            <input type="submit"  value="Save"  class="button success  large">
            
          </form>

          
          

        </div>
      </div>
    <!-- content here -->
</div>
    </div>
</div>
</div>

{{--

@push('scriptsTop')
<script>
const modelCon = $('.model-container');
$('.btn-close').click(()=>{modelCon.hide()})




function requestConfrimOpen(){
modelCon.css('display','flex');


function getVal(argument) {
const requestForm = argument;
//const requestForm = $('#requestForm');
const getId = (finder)=>{
 return requestForm.find(`[name="${finder}"]`);
}
return {
type : getId('type'),
number :getId('number'),
vendor :getId('vendor'),
number_confirm : getId('number_confirmation'),
amount : getId('amount'),
amount_confirm : getId('amount_confirmation'),
senderNumber : getId('senderNumber'),
senderName : getId('senderName'),
chargechecked : getId('chargechecked'),

}
}


let rfc = $('#requestFormConrim');
let rf = $('#requestForm');


 getVal(rfc).type.val( getVal(rf).type.val())
 getVal(rfc).vendor.val( getVal(rf).vendor.val())
 getVal(rfc).number.val( getVal(rf).number.val())
 getVal(rfc).number_confirm.val( getVal(rf).number_confirm.val())
 var amount = parseInt(getVal(rf).amount.val())
 var amountConf =parseInt(getVal(rf).amount_confirm.val());

 if (getVal(rf).chargechecked.attr('checked')) {
alert(222)
amount = Math.ceil(amount+(amount*0.02));
amountConf = Math.ceil(amountConf+(amountConf*0.02));
 }else{
amount = parseInt(getVal(rf).amount.val())
amountConf =parseInt(getVal(rf).amount_confirm.val());
alert(11)
 }
 getVal(rfc).amount.val(amountConf)
 getVal(rfc).amount_confirm.val(amountConf)
 getVal(rfc).senderNumber.val( getVal(rf).senderNumber.val())
 getVal(rfc).senderName.val( getVal(rf).senderName.val())
modelCon.find(`[data-text="number"]`).text(getVal(rf).number.val())
modelCon.find(`[data-text="amount"]`).text(amount)
modelCon.find(`[data-text="senderName"]`).text(getVal(rf).senderName.val())
modelCon.find(`[data-text="senderNumber"]`).text(getVal(rf).senderNumber.val())


}




</script>

@endpush
--}}