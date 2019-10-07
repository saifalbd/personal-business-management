@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Create New Rate Page')
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
    @component('forms.tariffCreate',compact('tariffList'))
    @endcomponent
@endsection