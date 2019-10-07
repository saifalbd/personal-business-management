@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Success Page')
@section('scriptTagBottom')

<script src="{{ asset('assets/js/successPage.js') }}"></script>
@endsection
@section('leftMenu')

@component('menus.leftMenu', compact('leftMenu'))
@endcomponent

@endsection

@section('topMenu')

@component('menus.topMenu', compact('topMenu'))
@endcomponent

@endsection

@section('optionBar')
    
@endsection

@section('content')
    @component('tables.successTable',compact('info'))
@endcomponent
@endsection