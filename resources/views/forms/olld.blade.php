<form data-role="validator" method="post" action="{{route('request.store')}}" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="row pt-2 pb-2">
<!--start-->
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
<!--end-->
<!--start-->

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
<!--end-->
<!--start-->

        <div class="cell-md-6 pt-2">
          



<input 
class="large" 
type="number" 
name="number" 
data-role="input" 
data-custom-buttons="requestNumber"
data-validate="required length=11"
id="requestNumber" 
>
        </div>

        <div class="cell-md-6 pt-2">
            <p>Request Number Confrim</p>
<input 
type="number" 
data-role="input" 
name="number_confirmation" 
data-validate="required length=11 equals=number" 
data-custom-buttons="requestNumberConfrim" >
<span class="invalid_feedback">mustbe select vendor</span>
        </div>

        <div class="cell-md-6 pt-2">
            <p>Amount</p>
<input 
type="number" 
name="amount" 
data-role="input"
data-validate="required minlength=3 maxlength=5"
>
<span class="invalid_feedback">mustbe select vendor</span>
        </div>
        <div class="cell-md-6 pt-2">
            <p>Amount Confrim</p>
<input 
type="number" 
name="amount_confirmation" 
data-role="input"
data-validate="required equals=amount" 
 >
 <span class="invalid_feedback">mustbe select vendor</span>
        </div>
        <div class="cell-md-6 pt-2">
         
<p>Sender Name</p>
<input type="text" data-role="input" name="senderName"  
data-validate="required minlength=4 maxlength=30">
        </div>
       <div class="cell-md-6 pt-2">
            <p>Sender Number</p>
<input
 type="text" 
data-role="input" 
name="senderNumber"
data-validate="required length=8">
<span class="invalid_feedback">mustbe select vendor</span>
        </div>

       <div class="cell-md-12 pt-4 text-center">
    
       
    </div>
        

    </div>

</form>

@push('scriptsTop')
<script>





</script>

@endpush