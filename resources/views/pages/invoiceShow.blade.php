@extends('layouts.app')

@section('title', 'Page Title')

@if($info->canVendor)
@section('pageTitle', $info->vendor->name.' Invoice Page')
@endif
@if($info->canCustomer)
    @section('pageTitle', $info->customer->name.' Invoice Page')
@endif


@section('scriptTagBottom')


@endsection
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
    @component('tables.invoice.infoTable',compact('info'))
    @endcomponent
    @component('tables.invoice.orderTable',compact('info'))
    @endcomponent
    @if($info->canCustomer)
        @component('tables.invoice.dueTable',compact('info'))
        @endcomponent
        @component('tables.invoice.paidTable',compact('info'))
        @endcomponent
        @endif
    @if($info->canvendor)
    @component('tables.invoice.debitTable',compact('info'))
    @endcomponent
    @component('tables.invoice.creditTable',compact('info'))
    @endcomponent
    @endif
    @component('tables.invoice.resultTable',compact('info'))
    @endcomponent

@endsection