@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Vendor list Page')

@section('scriptTagBottom')

    <script src="{{ asset('assets/js/vendorPage.js') }}"></script>
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
    @component('tables.vendorTable',['rowList'=>$rowList])
@endcomponent

{{--
@component('windows.vendorCradit')
@endcomponent

--}}



@endsection