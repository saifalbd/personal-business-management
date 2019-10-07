
<div class="row">
  <div class="cell-md-12">
    
    <table class="table table-border row-border cell-border row-hover" 
    custom-sortable="true" 
id="successTable" 
    >
        <thead>
      <tr class="filterTr">
        <th colspan="7">
          <div class="grid">
            <form class="row " data-role="validator"
            method="get"
             action="{{route('history.success.search')}}">
              
                <div class="cell-md-3">
              <select data-role="select" name="vendorid" value="{{ input('vendorid') }}"  data-find="vendorSelect">
      <option  data-template="<span class='mif-amazon icon'></span> $1">Select Vendor</option>
        @foreach(\App\Model\Vendor::all() as $vendor)
    <option value="{{$vendor->id}}" {{isEqual([$vendor->id,input('vendorid')],'selected')}} data-template="<span class='mif-amazon icon'></span> $1">{{$vendor->name}}</option>
  @endforeach
</select>
                </div>
                <div class="cell-md-4">
      <input type="text" data-role="calendarpicker" name="fromDate" value="{{input('fromDate')}}" data-prepend="from: ">
                </div>
                <div class="cell-md-3">
      <input type="text" data-role="calendarpicker"  name="toDate" value="{{input('toDate')}}" data-prepend="To: ">
                </div>
                <div class="cell-md-2">
                  <button class="button primary">submit</button>
                </div>
            </form>
          </div>
        </th>
      </tr>
 
        <tr   class="sortable-tr titleTr">
            <th  class="sortable-column">#</th>
            <th class="sortable-column">Number</th>
            <th class="sortable-column">Type</th>
            <th class="sortable-column">Amount</th>
            <th class="sortable-column">Vendor</th>
            <th class="sortable-column">Customer</th>
            <th class="sortable-column">Date</th>
           

        </tr>
        </thead>
        <tbody >
        	
          <tr v-for="(list ,index) in {{$info->list}}">
            <td 
clickThenCopy = "true"
 data-role="hint"
        data-hint-position="right"
        data-hint-text="click then do copy"
        :data-txt = "'serial:'+list.id"
            >@{{list.id}}</td>
             <td 
            clickThenCopy = "true"
             data-role="hint"
        data-hint-position="right"
        data-hint-text="click then do copy"
        :data-txt = "list.number"
            >@{{list.number}}</td>
            <td>@{{list.type}}</td>
              <td style="min-width: 100px">@{{list.amount|withSymbol('foreignSymbol')}}</td>

              <td>@{{list.vendor}}</td>
            <td 
        clickThenCopy = "true"
    data-role="hint"
        data-hint-position="right"
        data-hint-text="click then do copy"
        :data-txt = "list.customer">@{{list.customer}}</td>
            <td>@{{list.createdTxt}}</td>
            
          </tr>
          {{--
       	 @foreach($info->rowList as $list)
          <tr  @if($list->CommentTxt) data-role="hint" data-hint-text="{{$list->CommentTxt}}" @endif>
            <td 
clickThenCopy = "true"
 data-role="hint"
        data-hint-position="right"
        data-hint-text="click then do copy"
        data-txt = "serial:{{$list->id}}"
            >{{$list->id}}</td>
            <td 
            clickThenCopy = "true"
             data-role="hint"
        data-hint-position="right"
        data-hint-text="click then do copy"
        data-txt = "{{$list->order->number}}"
            >{{$list->order->number}}</td>
            <td>{{$list->order->type}}</td>
            <td>{{$list->amount}}</td>
            <td>{{$list->vendor->name}}</td>
            <td 
        clickThenCopy = "true"
    data-role="hint"
        data-hint-position="right"
        data-hint-text="click then do copy"
        data-txt = "{{$list->customer->name}}">{{$list->customer->name}}</td>
<td><small>{{$list->CreatedText}}</small></td>

          </tr>
          @endforeach
          --}}
        </tbody>
 <tfoot>
     <tr class="titleTr">
       <th colspan="9">
         
         <div class="row">
           <div class="cell-md-6 offset-md-3" >
               <table class="table">
              <tr class="titleTr">
       
        <th colspan="2">Total Amount</th>
       <th>{{$info->sum->amount}}</th>
      </tr>
      
           </table>
           
         </div>
         </div>
       </th>
     </tr>
    </tfoot>
    </table>
  </div>


 <div class="container pagination-box">
     {!!$info->paginationHtml!!}

</div>


 



</div>

