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

<form method="get" class="addRemoveForm" action="{{ route('changeEdit.editCustomerUpdate',['customerId'=>$info->id]) }}" accept-charset="UTF-8" style="padding: 25px 100px;" data-role="validator">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="customerID" value="{{$info->id}}">
  <div class="row pt-2 pb-2">
  @component('others.editTopBar',['txt'=>'customer Edit','nameId'=>'customerEdit'])
@endcomponent

     <div class="cell-md-6 pt-2">
            <p>Customer Name</p>
<input class="large" name="customerName" type="text" value="{{$info->name}}" data-role="input"
data-validate="required">
        </div>
     <div class="cell-md-6 pt-2">
            <p>Customer Phone</p>
<input class="large" name="customerPhone" type="text" value="{{$info->phone}}" data-role="input"
data-validate="required">
        </div>

    <div class="cell-md-6 pt-2">
        @component('others.editTopBar',['txt'=>'Confrim Name','nameId'=>'customerNameConfrim'])
@endcomponent  
        </div>
      <div class="cell-md-6 pt-2">
        @component('others.editTopBar',['txt'=>'Confrim Phone','nameId'=>'customerPhoneConfrim'])
@endcomponent  
        </div>
     
        <div class="cell-md-6 pt-2">

            <p>City Name</p>
<input class="large" name="city" type="text" value="{{$info->city}}" data-role="input"
data-validate="required">
        </div>



      <div class="cell-md-6 pt-2">

          <p>Select Tarif</p>
          <select
                  data-role="select"
                  name="tariffId"
                  data-validate="required"
          >
              @foreach($info->tariffList as $list)
                  <option value="{{$list->id}}" data-template="<span class='mif-mobile icon'></span> $1"
                          @if($list->id ==$info->id) selected @endif
                  >
                      {{$list->name}}
                  </option>

              @endforeach
          </select>

      </div>
      <div class="cell-md-6 pt-2">
          @component('others.editTopBar',['txt'=>'Confrim City','nameId'=>'customerCityConfrim'])
          @endcomponent
      </div>
      <div class="cell-md-6 pt-2">
          @component('others.editTopBar',['txt'=>'Confrim Tariff','nameId'=>'customerTariffConfrim'])
          @endcomponent
      </div>

     <div class="cell-md-12 pt-2">
            <p>Comments</p>
<input class="large" name="comment" type="text" data-role="input">
        </div>


       <div class="cell-md-12 pt-4 text-center">
        <button class="button primary">submit</button>
    </div>
        

    </div>

</form>




@endsection





