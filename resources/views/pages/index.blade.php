
{{--
(new \App\Exceptions\FlashSession())->withFormErrors($errors)->serverMessage()
--}}

@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Request Page')

@push('scriptsTop')

<script src="{{ asset('assets/js/requestPage.js') }}"></script>
<noscript src="{{ asset('assets/js/showRates.js') }}"></noscript>
@endpush


@push('scriptsBottom')

<script src="{{ asset('assets/js/requestPageDown.js') }}"></script>
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

@component('forms.requestForm',$info)
@endcomponent
@component('dialogs.requestConfrimdialog')
@endcomponent

<div class="fix-rate-btn-box" style="display: flex;
    flex-direction: column;">
    <button class="button light" id="showRate-btn">Show Rate</button>
    <button class="button light mt-2" id="showConvert-btn">Show Convert</button>
</div>


@component('dialogs.numberZoomdialogsDemo')
@endcomponent





@endsection




@if(isset($sideOff) && $sideOff)

@push('scriptsTop')
<script>

	/*
   $(document).ready(()=>{
   	var asideSize = '400px';
   $('main').children('aside').css(
   	{'width':asideSize,'color':'#4c0358'}
   	);
   $('main').children('article').css('margin-left', asideSize);
   })
   */
</script>

@endpush


@endif




