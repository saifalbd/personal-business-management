{{--method="post" action="{{route('payment.update')}}"--}}


<form data-role="validator"  accept-charset="UTF-8" 
method="get" action="{{route('payment.update',['id'=>$info->id])}}" 
 style="background: #0b154c; padding: 100px; color: #ffff;">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="payment_id" value="{{$info->id}}">
        <input type="hidden" name="order_id" value="{{$info->order->id}}">
        <input type="hidden" name="customer_id" value="{{$info->customer->id}}">
        <input type="hidden" name="vendor_id" value="{{$info->vendor->id}}">

  <div class="row pt-2 pb-2">
<div class="cell-md-12" style="background: red;">
<div class="row">
    <div class="stub d-flex flex-align-center" style="width:150px; background:black; color:white;">vendor Gourp</div>
<div class="cell text-right">
    <input type="checkbox" name="vendorGroup" data-role="checkbox" data-caption="Vendor Edit" data-caption-position="left">
</div>
</div>
</div>
        <div class="cell-md-6 offset-md-3 pt-2">
           <p>Vendor</p>
            <select 
            data-role="select"
            name="vendor"
            data-validate="required"
            >
    @foreach(\App\Model\Vendor::all() as $vendor)
    <option value="{{$vendor->id}}" data-template="<span class='mif-user icon'></span> $1" 
        @if($vendor->id ==$info->vendor->id) selected @endif
        >{{$vendor->name}}</option>
    @endforeach
    
</select>
<span class="invalid_feedback">mustbe select vendor</span>
        </div>

<div class="cell-md-12 mt-3" style="background: red;">
<div class="row">
    <div class="stub d-flex flex-align-center" style="width:150px; background:black; color:white;">Order Group</div>
<div class="cell text-right">
   <input type="checkbox" name="orderGroup" data-role="checkbox" data-caption="Order Edit" data-caption-position="left">
</div>
</div>
</div>

        <div class="cell-md-6 offset-md-3 pt-2">
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
data-role="input" 
data-validate="required length=11"
id="requestNumber" 
value="{{$info->order->number}}" 
>
        </div>

        <div class="cell-md-6 pt-2">
            <p>Request Number Confrim</p>
<input 
type="number" 
data-role="input" 
name="number_confirmation" 
data-validate="required length=11 equals=number" 
value="{{$info->order->number}}" 
 >
        </div>

<div class="cell-md-12 mt-3" style="background: red;">
<div class="row">
    <div class="stub d-flex flex-align-center" style="width:150px; background:black; color:white;">Payment Group</div>
<div class="cell text-right">
     <input type="checkbox" name="paymentGroup" data-role="checkbox" data-caption="Payment Edit" data-caption-position="left">
</div>
</div>
</div>

        <div class="cell-md-4 offset-md-2 pt-2">
            <p>Amount</p>
<input 
type="number" 
name="amount" 
data-role="input"
data-validate="required minlength=3 maxlength=5"
value="{{$info->amount}}" 
>
        </div>
        <div class="cell-md-4 pt-2">
            <p>Amount Confrim</p>
<input 
type="number" 
name="amount_confirmation" 
data-role="input"
data-validate="required equals=amount" 
value="{{$info->amount}}" 
 >
        </div>

<div class="cell-md-12 mt-3" style="background: red;">
<div class="row">
    <div class="stub d-flex flex-align-center" style="width:150px; background:black; color:white;">Customer Group</div>
<div class="cell text-right">
    <input type="checkbox" name="customerGroup" data-role="checkbox" data-caption="Customer Edit" data-caption-position="left">
</div>
</div>
</div>

      
        <div class="cell-md-6 offset-md-3 pt-2">
         
<p>Sender Name</p>
<select 
data-role="select" 
name="senderId"
data-validate="required"
>
@foreach(\App\Model\Customer::select('id','phone','name')->get() as $list)
    <option value="{{$list->id}}" data-template="<span class='mif-mobile icon'></span> $1" 
 @if($list->id ==$info->customer->id) selected @endif
        >
    {{$list->phone}}- {{$list->name}} {{$info->customer->id}}
</option>

@endforeach
</select>

        </div>

      <div class="cell-md-4 pt-2">
            <p>Comment Type</p>
<select 
data-role="select" 
name="commentType"
data-validate="required"
>
    <option value="edit" data-template="<span class='mif-mobile icon'></span> $1" selected>Edit Amount</option>
    <option value="vendor" data-template="<span class='mif-mobile icon'></span> $1">vendor</option>
    <option value="order" data-template="<span class='mif-mobile icon'></span> $1">order</option>
    <option value="customer" data-template="<span class='mif-mobile icon'></span> $1">customer</option>
</select>
<span class="invalid_feedback">mustbe select Request Type</span>
        </div>
    <div class="cell-md-8 pt-2">
            <p>Comments</p>
<input
type="text" 
data-role="input" 
name="comment">
        </div>
  

       <div class="cell-md-12 pt-4 text-center">
    
        <button type="submit"  id="tkddkdkdkdk" class="button primary large">Large button</button>
    </div>
        

    </div>

</form>
