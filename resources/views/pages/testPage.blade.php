
{{--
(new \App\Exceptions\FlashSession())->withFormErrors($errors)->serverMessage()
--}}

@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', 'Request Page')



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

	{{--@livewire('make-order')--}}
<show-rates v-if="showRate"></show-rates>
<show-finder v-if="showFinder" @findingitem="findingItem"></show-finder>
	<order-make :vendors='{{$info['vendors']}}' action="{{route('payment.orderPayStore')}}"
				token="{{csrf_token()}}" :orderitem="pushFindigItem"></order-make>

	@component('dialogs.requestConfrimdialog')
	@endcomponent

	<div class="fix-rate-btn-box" style="display: flex;
    flex-direction: column;">

		<button class="button light" id="showRate-btn" @click="showRate = showRate?false:true">
<span v-if="!showRate" >Show Rate</span>
<span v-if="showRate" >Hide Rate</span>
</button>
		<button class="button light mt-2" id="showConvert-btn" @click="showConvert">Show Convert</button>
		<button
		class="button light mt-2"  @click="showFinder= showFinder?false:true">
		<span v-if="!showFinder" >Show Finder</span>
		<span v-if="showFinder" >Hide Finder</span>
	</button>

	</div>


	@component('dialogs.numberZoomdialogsDemo')
	@endcomponent





@endsection
