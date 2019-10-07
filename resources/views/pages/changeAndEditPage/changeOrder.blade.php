@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Edit and change Page')



@section('leftMenu')

@component('menus.leftMenu', ['leftMenu'=>$leftMenu])
@endcomponent

@endsection

@section('topMenu')

@component('menus.topMenu', ['topMenu'=>$topMenu])
@endcomponent

@endsection



@section('optionBar')

@endsection

@section('content')

<form method="get" class="addRemoveForm" action="{{ route('changeEdit.changeOrderUpdate',['payId'=>$info->id]) }}" accept-charset="UTF-8" style="padding: 25px 100px;" data-role="validator">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="paymentID" value="{{$info->id}}">
        <input type="hidden" name="vendorID" value="{{$info->vendor->id}}">
  <div class="row pt-2 pb-2">
  @component('others.editTopBar',['txt'=>'payment Edit','nameId'=>'paymentCheck'])
@endcomponent
<div class="cell-md-6 offset-md-3">
	 @component('others.payInfo',['info'=>$info])
@endcomponent
</div>
     <div class="cell-md-6 offset-md-3 pt-2">
             <p>Order Type</p>
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
    <div class="cell-md-8 offset-md-2 pt-2">
            <p>Comments</p>
<input class="large" name="comment" type="text" data-role="input"
data-validate="required">
        </div>
       <div class="cell-md-12 pt-4 text-center">
        <button class="button primary">submit</button>
    </div>
        

    </div>

</form>




@endsection





