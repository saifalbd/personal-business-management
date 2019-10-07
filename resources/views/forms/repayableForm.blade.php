
<form method="get" class="addRemoveForm"
 action="{{ route('repayable.store',['customerid'=>$info->id]) }}" accept-charset="UTF-8" style="padding: 100px;" data-role="validator">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="customer_id" value="{{$info->id}}">
  <div class="row pt-2 pb-2">
      <div class="cell-md-6 offset-md-3 pt-2">

            <p>Vendor Type</p>
            <select data-role="select" name="type">
        @foreach($info['repayable'] as $list)
    <option value="{{$list->option_value}}" data-template="<span class='mif-user icon'></span> $1">{{$list->option_name}}</option>
   
    
    @endforeach
</select>
        </div>
     <div class="cell-md-6 pt-2">
            <p>Due *(Local Curency)</p>
<input class="large" name="due" type="text" data-role="input" data-validate=""
id="fromRate">
        </div>
     
        <div class="cell-md-6 pt-2">
            <p>Payment *(Local Curency)</p>
<input class="large" name="payment" type="text" data-role="input" data-validate="" 
id="toRate">
        </div>
<div class="cell-md-12 pt-2">
    <p>Comment</p>
    <input class="large" name="comment" type="text" data-role="input" data-validate="">
</div>
       <div class="cell-md-12 pt-4 text-center">
        <button class="button primary">Large button</button>
    </div>
        

    </div>

</form>

