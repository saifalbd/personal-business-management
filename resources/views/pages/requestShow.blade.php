@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', $info->vendor->name.' Payment Show And Copy')

@section('scriptTagBottom')

<script src="{{ asset('assets/js/requestShowPage.js') }}"></script>
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
  

    <div style="background: #0b154c; padding: 50px; color: #ffff;">
    	
    
       
  <div class="row pt-2 pb-2">
  	<div class="cell-12" style="position: absolute; z-index: -99999; opacity: 0.1; width: 5px; height: 5px; overflow: hidden;">
	@if($info->vendor->type =='online')
<textarea   data-copy-find="numberCopy" cols="1" rows="1" style="text-align: left;">{{$info->order->number}}</textarea>
<textarea   data-copy-find="amountCopy" cols="1" rows="1" style="text-align: left;">{{$info->amount}}</textarea>
  	
  	@endif
  	@if($info->vendor->type =='manual')
  	<textarea   data-copy-find="bothCopy" cols="4" rows="2" style="text-align: left;">
    serial:{{$info->id}}
{{ucfirst($info->order->type)}}::{{$info->order->number}}
Amount:: {{withSymbol($info->amount,config('currency.foreignSymbol'))}}
{{ucwords(numberTowords($info->amount))}}
  	</textarea>
  	@endif
  	</div>
  
     <div class="cell-md-10 offset-md-1 pt-2" style="font-size: 30px;">
            <div class="row">
              <div class="stub" style="width:150px; background: black; color:white; text-align: right;">
                Name
              </div>
              <div class="cell">
                {{$info->customer->name}}
              </div>
            </div>
            <div class="row  mt-2">
              <div class="stub" style="width:150px; background: black; color:white; text-align: right;">
                Time
              </div>
              <div class="cell">
                 {{$info->CreatedText}}
              </div>
            </div>
@if($info->vendor->type =='manual')

            <div class="row  mt-2  border bd-cyan">
              <div class="stub" style="width:150px; background: black; color:white; text-align: right;">
                Type
              </div>
              <div class="cell">
                {{ucfirst($info->order->type)}}
              </div>
            </div>
              <div class="row mt-2  border bd-cyan">
                	<div class="stub" style="width:150px; background: black; color:white; text-align: right;">
            		Number:
            	</div>
            	<div class="cell">
            		{{$info->order->number}}
            	</div>
            </div>
         <div class="row mt-2  border bd-cyan">
                	<div class="stub" style="width:150px; background: black; color:white; text-align: right;">
            		Amount:
            	</div>
            	<div class="cell">
                    {{withSymbol($info->amount,config('currency.foreignSymbol'))}}
            	</div>
            </div>

            <div class="row mt-2  border bd-cyan">
              <div class="stub" style="width:150px; background: black; color:white; text-align: right;">
                Words:
              </div>
             
              <div class="cell">
                {{ucwords(numberTowords($info->amount))}}
              </div>
            </div>
          <div class="row pt-4">
          	 <div class="cell-md-12  text-center">
          	 	<button class="button primary large" data-copy="bothCopy">copy Me</button>
          	 </div>
          </div>

 @endif
 @if($info->vendor->type =='online')
<div class="row row mt-2 border bd-cyan">
            	<div class="stub" style="width:150px; background: black; color:white; text-align: right;">
            		Type
            	</div>
            	<div class="cell">
            		{{$info->order->type}}
            	</div>
            </div>
   <div class="row mt-2 border bd-cyan">
            	<div class="stub" style="width:150px; background: black; color:white; text-align: right;">
            		Number:
            	</div>
            	<div class="cell">
            		{{$info->order->number}}
            	</div>
                <div class="cell">
            		<button data-copy="numberCopy" class="button primary">copy Me</button>
            	</div>
            </div>
         <div class="row mt-2 border bd-cyan">
            	<div class="stub" style="width:150px; background: black; color:white; text-align: right;">
            		Amount:
            	</div>
            	<div class="cell">
                    {{withSymbol($info->amount,config('currency.foreignSymbol'))}}
            	</div>
                <div class="cell">
            		<button data-copy="amountCopy" class="button primary">copy Me</button>
            	</div>
            </div>
                <div class="row mt-2">
              <div class="stub" style="width:150px; background: black; color:white; text-align: right;">
                Words:
              </div>
             
              <div class="cell">
                {{ucwords(numberTowords($info->amount))}}
              </div>
            </div>
  @endif

        </div>
  
      




   
        

    </div>

</div>
<div class="grid">
  <div class="row">
    <div class="cell-md-12">
      Last {{count($rowList)}} Request
    </div>
    @foreach($rowList as $list)
    <!--start cell-->
    <div class="cell-md-4 pt-2">
    <a  href="{{route('request.show', ['id' => $list->id])}}" class="grid" style="background: black; color: #ffff; text-decoration: none;">
    <div class="row border  bd-cyan m-0" >
      <div class="cell">
        serial
      </div>
      <div class="cell">{{$list->id}}</div>
    </div>
    <div class="row border  bd-cyan m-0" >
      <div class="cell">
        Time
      </div>
      <div class="cell">{{$list->CreatedText}}</div>
    </div>
     <div class="row border  bd-cyan m-0" >
      <div class="cell">
        number
      </div>
      <div class="cell">{{$list->order->number}}</div>
    </div>
     <div class="row border  bd-cyan m-0" >
      <div class="cell">
        amount
      </div>
      <div class="cell">{{$list->amount}}</div>
    </div>
    </a>
    </div>
    <!--start cell-->
    @endforeach
  </div>
</div>
@endsection