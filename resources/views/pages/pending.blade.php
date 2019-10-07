@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Pending Page')
@section('scriptTagBottom')

<script src="{{ asset('assets/js/pendingPage.js') }}"></script>
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

    @component('tables.pendingTable',compact('info'))
@endcomponent
@endsection