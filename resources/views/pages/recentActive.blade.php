@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Recent Active')
@section('scriptTagBottom')

    <script src="{{ asset('assets/js/pendingPage.js') }}"></script>
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
    @component('tables.recentActiveTable',compact('info'))
    @endcomponent
@endsection