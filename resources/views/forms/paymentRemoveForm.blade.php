
<form class="addRemoveForm" method="get" action="{{ route('payment.remove',['id'=>$info->id]) }}" accept-charset="UTF-8" style=" padding: 100px;">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="paymentType" value="orderPayment">
        <input type="hidden" name="paymentId" value="{{$info->id}}">
        

  <div class="row pt-2 pb-2">
    <div class="cell-md-12 pt-2">
        <h1>
            are You Confirm Remove This amount
        </h1>
    </div>
    <div class="cell-md-12 pt-2">
        <div class="row">
    <div class="stub" style="width: 200px; background: black;">
        Amount:
    </div>
    <div class="cell">
         {{$info->amount}}
    </div>   
        </div>
        <div class="row pt-2">
    <div class="stub" style="width: 200px; background: black;">
        payment Number:
    </div>
    <div class="cell">
         {{$info->order->number}}
    </div>   
        </div>
    </div>


     <div class="cell-md-6 pt-2">
            <p>Customer Name</p>
<input class="large" name="customerName" type="text" data-role="input" required>
        </div>
     <div class="cell-md-6 pt-2">
            <p>Customer Number</p>
<input class="large" name="customerNumber" type="text" data-role="input"  required>

        </div>
     <div class="cell-md-6 pt-2">
            <p>Amount</p>
<input class="large" name="amount" type="text" data-role="input"  required>

        </div>   
  <div class="cell-md-6 pt-2">
            <p>Why You are Remove This</p>
<input class="large" name="comment" type="text" data-role="input">

        </div>

    
    




       <div class="cell-md-12 pt-4 text-center">
    
        <button class="button primary">Large button</button>
    </div>
        

    </div>

</form>

@push('scriptsTop')
<script>
 
</script>

@endpush