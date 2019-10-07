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

<section>
	<div class="row">
		<div class="cell-md-8 offset-md-2">
			<div class="row rowInfo">
		<div class="cell-6 p-1">Vendor Name</div>
		<div class="cell-6 p-1">{{$info->name}}</div>
		<div class="cell-6 p-1">type</div>
		<div class="cell-6 p-1">{{$info->type}}</div>
		<div class="cell-6 p-1">active</div>
		<div class="cell-6 p-1">{{$info->ActiveTxt}}</div>

				@if($info->hasPendingInvoice)

					<div class="cell-6 p-1">Current Invoice</div>
					<div class="cell-6 p-1">
						<a href="{{route('invoice.show',['type'=>'vendor','id'=>$info->hasPendingInvoice->id])}}" class="button">Show</a>

					</div>
				@else
					<div class="cell-6 p-1">invoice Genarate</div>
					<div class="cell-6 p-1">

						@component('forms.invoiceGenarateFrom',['parent'=>'vendor','_id'=>$info->id])
						@endcomponent
					</div>


				@endif
				<div class="cell-6 p-1">Edit Vendor</div>
		<div class="cell-6 p-1">
			<a href="{{route('changeEdit.editVendor',['Vendorid'=>$info->id])}}" class="button info">edit</a>
		</div>	
	</div>

		</div>
	</div>
</section>
  
  @component('tables.vendorRequestTable',['info'=>$info])
@endcomponent



@endsection