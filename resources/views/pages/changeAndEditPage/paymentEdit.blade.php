@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Request Edit Page')

@push('scriptsTop')

<script src="{{ asset('assets/js/requestPage.js') }}"></script>
@endpush

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

<form method="get" class="addRemoveForm" action="{{ route('changeEdit.updateAmount',['payId'=>$info->id]) }}" accept-charset="UTF-8" style="padding: 25px 100px;" data-role="validator">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="paymentID" value="{{$info->id}}">
        <input type="hidden" name="vendorID" value="{{$info->vendor->id}}">
  <div class="row pt-2 pb-2">
  @component('others.editTopBar',['txt'=>'payment Edit','nameId'=>'paymentCheck'])
@endcomponent
<div class="cell-md-6 offset-md-3">
	<div class="row">
		<div class="cell-6 p-1">Customer Name</div>
		<div class="cell-6 p-1">{{$info->customer->name}}</div>
		<div class="cell-6 p-1">Number</div>
		<div class="cell-6 p-1">{{$info->order->number}}</div>
		<div class="cell-6 p-1">Type</div>
		<div class="cell-6 p-1">{{$info->order->type}}</div>
		<div class="cell-6 p-1">Vendor Name</div>
		<div class="cell-6 p-1">{{$info->vendor->name}}</div>
	</div>
</div>
     <div class="cell-md-6 pt-2">
            <p>old Amount</p>
<input class="large" name="oldAmount" type="number" data-role="input"
data-validate="required notequals=newAmount"
id="foldAmount">
        </div>
     
        <div class="cell-md-6 pt-2">
            <p>new Amount</p>
<input class="large" name="newAmount" type="number" data-role="input"
data-validate="required notequals=oldAmount"
id="newAmount">
        </div>
     <div class="cell-md-6 offset-md-3 pt-2">
            <p>Customer Bill -(local curency)</p>
<input class="large" name="customerBill" type="number" data-role="input"
data-validate="required notequals=oldAmount notequals=newAmount"
id="customerBill">
        </div>

       <div class="cell-md-12 pt-4 text-center">
        <button class="button primary">submit</button>
    </div>
        

    </div>

</form>




@endsection





