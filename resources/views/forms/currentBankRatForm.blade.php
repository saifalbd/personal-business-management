
<form method="get" class="addRemoveForm" action="{{ route('rate.setBankRate') }}" accept-charset="UTF-8" style="padding: 100px;" data-role="validator">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="row pt-2 pb-2">
   <div class="cell-md-6 offset-md-3 pt-2 text-center">
       <p class="text-capitalize">
           Previous Rate is 24.20
       </p>
   </div>
     
        <div class="cell-md-6 offset-md-3 pt-2">
            <p>Add Curent Bank Rate</p>
<input class="large" name="bankRate" type="number" data-role="input" data-validate="required" 
id="bankRate">
        </div>
<div class="cell-md-12 text-center" id="ShowRate">
    
</div>
       <div class="cell-md-12 pt-4 text-center">
        <button class="button primary">Large button</button>
    </div>
        

    </div>

</form>

