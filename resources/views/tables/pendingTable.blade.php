   <table class="table table-border row-border cell-border row-hover"
          id="peddingTable"
custom-sortable="true"
   >
    <thead>

    <tr  class="filterTr">
        <div class="grid">
            <div class="row">
               <div class="cell cell-md-4">
                   <input data-find="numberSelect" type="text" data-role="input" data-prepend="number: ">
               </div>
                <div class="cell cell-md-4">
                    <input data-find="amountSelect" type="text" data-role="input" data-prepend="amount: ">
                </div>
                <div class="cell cell-md-4">
                    <input data-find="customerSelect" type="text" data-role="input" data-prepend="customer: ">
                </div>
            </div>

        </div>
    </tr>
    <tr  class="filterTr">
        <div class="grid">
            <div class="row">
                <div class="cell cell-md-4">
                    <input data-find="phoneSelect" type="text" data-role="input" data-prepend="phone: ">
                </div>
                <div class="cell cell-md-4">
                    <select data-role="select" data-url="{{route('genaral.pending')}}" data-find="vendorSelect">
                        <option value="" data-template="<span class='mif-amazon icon'></span> $1">Select Vendor</option>
                        <option value="" data-template="<span class='mif-amazon icon'></span> $1">All</option>
                        @foreach(\App\Http\Helper\dropDown\VendorDrops::active() as $vendor)
                            <option value="{{$vendor->id}}"  data-template="<span class='mif-amazon icon'></span> $1"
                                    {{isEqual([$vendor->id,input('vendorid')],'selected')}}>{{$vendor->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="cell cell-md-4">
                    <select data-role="select" data-url="{{route('genaral.pending')}}" data-find="dateSelect">
                        <option  data-template="<span class='mif-amazon icon'></span> $1">Select Date</option>
                        <option  data-template="<span class='mif-amazon icon'></span> $1">All</option>

                        <option  data-template="<span class='mif-amazon icon'></span> $1"
                                 v-for="(item,index) in {{$info->dateDivider}}"
                                 :value="item.val" >@{{item.txt}}</option>

                    </select>
                </div>
            </div>

        </div>

    <tr class="sortable-tr titleTr">
        <th >
            <input id="filterClick" type="checkbox" data-role="checkbox" >
        </th>
        <th class="sortable-column">Number</th>
        <th class="sortable-column">type</th>
        <th class="sortable-column">Amount</th>
        <th class="sortable-column">bill</th>
        <th class="sortable-column">Vendor</th>
        <th class="sortable-column">Customer</th>
        <th class="sortable-column">Phone</th>
        <th class="sortable-column">date</th>
        
        <th class="">Button</th>

    </tr>
    </thead>
{{-- @if($list->CommentTxt) data-role="hint" data-hint-text="{{$list->CommentTxt}}" @endif--}}
    <tbody id="peddingTableTbody">
    	<tr v-for="(list ,index) in {{$info->rowList->list->toJson()}}" :tabindex="list.id"
   
      
    >
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
            <td  v-on:click="billUpdate(list.id,$event)"  style="min-width: 100px;cursor: pointer">
                @{{list.bill|withSymbol('localSymbol')}}</td>

        <td>@{{list.vendor}}</td>
        <td 
         clickThenCopy = "true"
    data-role="hint"
        data-hint-position="right"
        data-hint-text="click then do copy"
        :data-txt = "list.customer">@{{list.customer}}</td>
        <td>@{{list.phone}}</td>
        <td><small>@{{list.createdTxt}}</small></td>
       
        <td style="padding:2px 2px; min-width:100px;  ">
        <button data-find="active" :data-value="list.id" data-role="active" class="button  mini rounded"><span
                    class="mif-done"></span></button>

  <div class="dropdown-button" style="height: 20px;">
    <button class="button mini rounded"><span class="mif-embed2"></span></button>
    <ul class="d-menu" data-role="dropdown">
      <li 
      v-for="(item,index) in list.dropdown"
      >
        <a :href="item.url" v-text="item.txt"></a>
      </li>
       
    </ul>
</div>

      
          
        </td>
   		</tr>
   		
    </tbody>
 <tfoot>
     <tr class="titleTr">
       <th colspan="10">
         
         <div class="row">
           <div class="cell-md-6 offset-md-3" >
               <table class="table">
              <tr class="titleTr">
       
        <th colspan="2">Total Amount</th>
       <th>{{$info->rowList->sum->amount}}</th>
      </tr>
      
           </table>
           
         </div>
         </div>
       </th>
     </tr>
    </tfoot>
</table>













@push('scriptsTop')
<script>


$(document).ready(()=>{
 const table = document.getElementById('numberFinderTable');



})



</script>

@endpush