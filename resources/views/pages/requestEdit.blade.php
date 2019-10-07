@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Request Edit Page')

@push('scriptsTop')

<script src="{{ asset('assets/js/requestPage.js') }}"></script>
@endpush

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

@component('forms.requestEdit',['info'=>$info])
@endcomponent




@endsection





