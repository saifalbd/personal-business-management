@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Customer Page')
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

    @component('tables.repayableCustomerTable', ['rowList'=>$rowList])
@endcomponent
@endsection