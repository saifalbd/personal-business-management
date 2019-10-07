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

<form method="get" class="addRemoveForm" action="{{ route('changeEdit.editVendorUpdate',['vendorId'=>$info->id]) }}" accept-charset="UTF-8" style="padding: 25px 100px;" data-role="validator">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="vendorID" value="{{$info->id}}">
  <div class="row pt-2 pb-2">
  @component('others.editTopBar',['txt'=>'Vendor Edit','nameId'=>'vendorEdit'])
@endcomponent

     <div class="cell-md-6 pt-2">
            <p>Vendor Name</p>
<input class="large" name="vendorName" type="text" value="{{$info->name}}" data-role="input"
data-validate="required">
        </div>
     <div class="cell-md-6 pt-2">
            <p>Vendor Rate</p>
<input class="large" name="vendorRate" type="text" value="{{$info->ExHistory->first()->ex_rate}}" data-role="input"
data-validate="required">
        </div>

    <div class="cell-md-6 pt-2">
        @component('others.editTopBar',['txt'=>'Confrim Name','nameId'=>'vendorNameConfrim'])
@endcomponent  
        </div>
      <div class="cell-md-6 pt-2">
        @component('others.editTopBar',['txt'=>'Confrim Rate','nameId'=>'vendorRateConfrim'])
@endcomponent  
        </div>
     
        <div class="cell-md-6 pt-2">

            <p>Vendor Type</p>
            <select data-role="select" name="vendorType">
    <option value="online" data-template="<span class='mif-user icon'></span> $1">online</option>
    <option value="manual" data-template="<span class='mif-user icon'></span> $1">Manual</option>
    
    
</select>
        </div>
     <div class="cell-md-6 pt-2">
          <p>Active</p>
            <select data-role="select" name="active">
    <option value="1" data-template="<span class='mif-user icon'></span> $1">active</option>
    <option value="0" data-template="<span class='mif-user icon'></span> $1">inActive</option>
    
    
</select>
        </div>
     <div class="cell-md-8 offset-md-2 pt-2">
            <p>comments</p>
<input class="large" name="comment" type="text" data-role="input">
        </div>


       <div class="cell-md-12 pt-4 text-center">
        <button class="button primary">submit</button>
    </div>
        

    </div>

</form>




@endsection





