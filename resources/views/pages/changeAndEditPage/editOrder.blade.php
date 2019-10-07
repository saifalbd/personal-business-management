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

    <form method="get" class="addRemoveForm" action="{{ route('changeEdit.editOrderUpdate',['orderId'=>$info->id]) }}" accept-charset="UTF-8" style="padding: 25px 100px;" data-role="validator">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="vendorID" value="{{$info->id}}">
        <div class="row pt-2 pb-2">
            @component('others.editTopBar',['txt'=>'Order Edit','nameId'=>'orderEdit'])
            @endcomponent

            <div class="cell-md-6 pt-2">
                <p>New Number</p>
                <input class="large" name="number" type="text" value="" data-role="input"
                       >
            </div>
                <div class="cell-md-6 pt-2">
                    <p>old Number</p>
                    <input class="large" name="oldNumber" type="text" value="{{$info->number}}" data-role="input"
                           data-validate="required">
                </div>

            <div class="cell-md-12 pt-2">
                @component('others.editTopBar',['txt'=>'Old Number','nameId'=>'numberConfirm'])
                @endcomponent
            </div>


            <div class="cell-md-6 pt-2">
                <p>Active</p>
                <select data-role="select" name="type">
                    <option value="personal" data-template="<span class='mif-user icon'></span> $1">personal</option>
                    <option value="agent" data-template="<span class='mif-user icon'></span> $1">agent</option>


                </select>
            </div>
                <div class="cell-md-6 pt-2">
                    <p>comments</p>
                    <input class="large" name="comment" type="text" data-role="input">
                </div>

                <div class="cell-md-6 pt-2">
                    @component('others.editTopBar',['txt'=>'Confirm Type','nameId'=>'typeConfirm'])
                    @endcomponent
                </div>



            <div class="cell-md-12 pt-4 text-center">
                <button class="button primary">submit</button>
            </div>


        </div>

    </form>




@endsection





