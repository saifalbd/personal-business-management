@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Rate Views Page')

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
    @component('tables.tariff.tariffListTable',compact('rowList'))
    @endcomponent
@endsection