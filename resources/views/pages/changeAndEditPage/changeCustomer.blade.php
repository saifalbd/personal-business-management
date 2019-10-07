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

<form method="get" class="addRemoveForm" action="{{ route('changeEdit.changeCustomerUpdate',['payId'=>$info->id]) }}" accept-charset="UTF-8" style="padding: 25px 100px;" data-role="validator">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="paymentID" value="{{$info->id}}">
        <input type="hidden" name="oldCustomerID" value="{{$info->customer->id}}">
  <div class="row pt-2 pb-2">
  @component('others.editTopBar',['txt'=>'payment Edit','nameId'=>'customerChange'])
@endcomponent
<div class="cell-md-6 offset-md-3">
	 @component('others.payInfo',['info'=>$info])
@endcomponent
</div>
     <div class="cell-md-8 offset-md-2 pt-2">
           <p>change customer</p>
<select 
data-role="select" 
name="newCustomerID"
data-validate="required"
>
@foreach($info->drops as $list)
    <option value="{{$list->id}}" data-template="<span class='mif-mobile icon'></span> $1" 
 @if($list->id ==$info->customer->id) selected @endif
        >
    {{$list->name}}:{{$list->phone}}
</option>

@endforeach
</select>
<span class="invalid_feedback">mustbe select Request Type</span>
        </div>
     


       <div class="cell-md-12 pt-4 text-center">
        <button class="button primary">submit</button>
    </div>
        

    </div>

</form>




@endsection





