{{--method="post" action="{{route('request.store')}}"--}}


<div class="row">
    <div class="cell-md-11 offset-md-1">
        


<form data-role="validator"  class="requestForm p-1" id="requestForm" accept-charset="UTF-8" 
 action="javascript:"
 data-on-validate-form="requestConfrimOpen()"
>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="row pt-2 pb-2">

        <div class="cell-md-6 pt-2">
           <p>Vendor</p>
            <select 
            data-role="select"
            name="vendor"
            data-validate="required"
            >
    @foreach($vendors as $vendor)
    <option value="{{$vendor->id}}" data-template="<span class='mif-user icon'></span> $1">{{$vendor->name}}</option>
    @endforeach
    
</select>
<span class="invalid_feedback">mustbe select vendor</span>
        </div>

        <div class="cell-md-6 pt-2">
            <p>Request Type</p>
<select 
data-role="select" 
name="type"
data-validate="required"
>
    <option value="personal" data-template="<span class='mif-mobile icon'></span> $1">Personal</option>
    <option value="agent" data-template="<span class='mif-mobile icon'></span> $1">Agent</option>
</select>
<span class="invalid_feedback">mustbe select Request Type</span>
        </div>

        <div class="cell-md-6 pt-2">
          
<p class="clear">
    <span class="place-left">Request Number</span>

    <span class="place-right" id="requestNumberLentgh"></span>
</p>


<input 
class="large" 
type="number" 
name="number" 
data-validate="required length=11"
id="requestNumber" 
data-role="input"
data-custom-buttons="numberFunOpen"
>
        </div>

        <div class="cell-md-6 pt-2">
            <p>Request Number Confrim</p>
<input 
type="number" 
data-role="input" 
name="number_confirmation" 
id="number_confirmation" 
data-validate="required length=11 equals=number" 
value="" 
data-custom-buttons="numberConfFunOpen"
 >
        </div>

        <div class="cell-md-5 pt-2">
            <p>Amount</p>
<input 
type="number" 
name="amount" 
data-role="input"
data-validate="required minlength=3 maxlength=5"
value="" 
>
        </div>
        <div class="cell-md-5 pt-2">
            <p>Amount Confrim</p>
<input 
type="number" 
name="amount_confirmation" 
data-role="input"
data-validate="required equals=amount" 
 >
        </div>
        <div class="cell-md-2 pt-2">
            <p>charge Added</p>
<input name="chargeChack"  type="checkbox" data-role="switch" checked>
        </div>
        <div class="cell-md-6 pt-2">
         
<p>Sender Name</p>
<input type="text" data-role="input" name="senderName"  id="senderName"  
data-validate="required minlength=4 maxlength=30">
        </div>
       <div class="cell-md-6 pt-2">
            <p>Sender Number</p>
<input
 type="text" 
data-role="input" 
name="senderNumber"
 id="senderNumber"
data-validate="required length=8">
        </div>
    <div class="cell-md-3 mt-2">
     <button type="button" class="button dark mini" id="advanceOpen">
        <span class="mif-plus"></span>
        Advance
     </button>
    </div>
<div class="cell-md-10 offset-md-1" id="advanceBox" style="display: none;">
    <div class="row">
    <div class="cell-md-6  pt-2">
             <p>Customer Cost - (Local)</p>
<input
 type="number" 
data-role="input" 
name="customerBill"
data-validate="equals=customerBill_confirmation">       
    </div>
    <div class="cell-md-6  pt-2">
             <p>Customer Cost Confrim - (Local)</p>
<input
 type="number" 
data-role="input" 
name="customerBill_confirmation"
data-validate="equals=customerBill">       
    </div>
     <div class="cell-md-12">
                <p>Comments</p>
    <input
    type="text" 
    data-role="input" 
    name="comment">
       </div>       
    </div>
</div>


       <div class="cell-md-12 pt-4 text-center">
    
        <button type="submit"  class="button primary large">SUBMIT</button>
    </div>
        

    </div>

</form>

    </div>
</div>
