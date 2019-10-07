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

    <form method="get" class="addRemoveForm" action="{{ route('changeEdit.updateBill',['payId'=>$info->id]) }}" accept-charset="UTF-8" style="padding: 25px 100px;" data-role="validator">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="paymentID" value="{{$info->id}}">
        <input type="hidden" name="oldVendorID" value="{{$info->vendor->id}}">
        <input type="hidden" name="customerID" value="{{$info->customer->id}}">
        <div class="row pt-2 pb-2">
            @component('others.editTopBar',['txt'=>'Vendor Change','nameId'=>'vendorChange'])
            @endcomponent
            <div class="cell-md-6 offset-md-3">
                @component('others.payInfo',['info'=>$info])
                @endcomponent
            </div>
            <div class="cell-md-8 offset-md-2 pt-2">
                <p>new bill</p>
                <input class="large" name="bill" type="number" data-role="input"
                       data-validate="required">


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





