@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', $info->name.' details Page')
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
				<div class="cell-6 p-1">Customer Name</div>
				<div class="cell-6 p-1">{{$info->name}}</div>
				<div class="cell-6 p-1">Number</div>
				<div class="cell-6 p-1">{{$info->phone}}</div>
				<div class="cell-6 p-1">city:</div>
				<div class="cell-6 p-1">{{$info->city}}</div>
				<div class="cell-6 p-1">Tariff:</div>
				<div class="cell-6 p-1">{{$info->tariff->name}}</div>
				@if($info->hasPendingInvoice)

					<div class="cell-6 p-1">Current Invoice</div>
					<div class="cell-6 p-1">
						<a href="{{route('invoice.show',['type'=>'customer','id'=>$info->hasPendingInvoice->id])}}" class="button">Show</a>

					</div>
				@else
					<div class="cell-6 p-1">invoice Genarate</div>
					<div class="cell-6 p-1">

						@component('forms.invoiceGenarateFrom',['parent'=>'customer','_id'=>$info->id])
						@endcomponent
					</div>


				@endif
				<div class="cell-6 p-1">repayable:</div>
		<div class="cell-6 p-1">
			<a href="{{route('repayable.create',['customerid'=>$info->id])}}" class="button">repayable add</a>
		</div>


		<div class="cell-6 p-1">Edit Customer</div>	
		<div class="cell-6 p-1">

			<a href="{{route('changeEdit.editCustomer',['customerid'=>$info->id])}}" class="button">edit</a>
		</div>

		@if(!count($info->payments))
		<div class="cell-6 p-1">Remove:</div>
		<div class="cell-6 p-1">
			<a href="" class="button">Remove Customer</a>
		</div>	
	@endif
	</div>
		
		</div>
	</div>
</section>

  <section>
  	  @component('tables.customerRequestTable',['info'=>$info])
@endcomponent
  </section>




@endsection