@extends('layouts.app')

@section('title', 'Page Title')

@section('pageTitle', 'Order '.(isset($info->vendor)?$info->vendor->name:'').' Reports Page')

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
    @component('tables.customerReportTable',compact('info'))
    @endcomponent
@endsection