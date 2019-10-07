@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', $info->name.' Tariff New Rate Page')
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
    @component('forms.rateEdit',compact('info'))
    @endcomponent
@endsection