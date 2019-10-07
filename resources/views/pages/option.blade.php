@extends('layouts.app')

@section('title', 'Page Title')
@section('pageTitle', $info['pageTitle'].' options Page')
@section('scriptTagBottom')

<script src="{{ asset('assets/js/optionPages.js') }}"></script>
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
   <div class="container options pt-3 pb-3">
<div class="card">
    <div class="card-header">
        options Values
    </div>
    @if(count($info['option']))
    <div class="card-content p-2">
        <div class="row">
          <div class="cell-md-12">
            <ul data-role="listview" data-selectable="true" id="Dlslss">
    <li data-caption="Option Values">
        <ul>
          @foreach($info['option'] as $list)
            <li data-icon="<span class='mif-folder fg-orange'>"  data-caption="{{$list->option_name}} value is {{$list->option_value}}" value="{{$list->id}}"></li>
          
              @endforeach
        </ul>
    </li>
 
</ul>
          </div>
            
        </div>
    </div>
   
    <div class="card-footer">
        <button class="button primary remove-selcted">
          Remove Selected
        </button>
    </div>
     @endif
    <div class="card-footer">
        <div class="row">
          <div class="cell-md-12">add Options Value and Name</div>
          <div class="cell-md-12">
            <form action="{{route('option.store.repayable')}}" method="get">
              <input name="groupName" type="hidden" value="repayable">
              <div class="row">
                <div class="cell-md-4">
                  <input type="text" name="optionValue" data-role="input" data-prepend="option: ">
                </div>
                <div class="cell-md-6">
                  <input type="text" name="optionName" data-role="input" data-prepend="Name: ">
                </div>
                <div class="cell-md-2">
                  <button class="button primary">
                    add
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>



   </div>

@endsection