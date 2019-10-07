
<div class="row">
  <div class="cell-md-12 text-right">

    <a class="button primary small" href="{{route('vendor.create')}}" style="color: #ffff;">add Vendor</a>
  </div>
  <div class="cell-md-12">
    

    <table class="table table-border row-border cell-border">
        <thead>
        <tr class="titleTr">
            <th width="20px">
                <span class="mif-done fg-cyan"></span>
            </th>
            <th class="sortable-column sort-asc">#</th>

            <th class="sortable-column sort-asc">Vendor Name</th>
            <th class="sortable-column sort-asc">Type</th>
            <th class="sortable-column sort-asc">Rate</th>
            <th class="sortable-column sort-asc">Stock</th>
            <th class="sortable-column sort-asc">add Credit</th>
            <th class="sortable-column sort-asc">add debit</th>
          

        </tr>
        </thead>
        <tbody id="vendorTableTbody">
        	@foreach($rowList as $list)
       		<tr>
           <td  width="20px">
               @if($list->active)
                   <span class="mif-done fg-cyan"></span>
                   @else
                   <span class="mif-cross fg-red"></span>
               @endif
           </td>
           <td>{{$list->id}}</td>
       			<td>
              <a href="{{route('vendor.show',$list->id)}}">{{$list->name}}</a>  
            </td>
       			<td>{{$list->type}}</td>
            <td>{{withSymbol($list->rate,config('foreignSymbol'))}}</td>
       			<td>
                    {{withSymbol($list->totalStockBalance,config('foreignSymbol'))}}
                </td>
            <td>
              <button id="vendorCreditAdd" class="button primary mini" vendor-info='@json(['id'=>$list->id,
              'name'=>$list->name])'
                      add-cradit>Add</button>
              <button class="button primary mini">show</button>
            </td>
            <td>
              <button  id="vendorDebitAdd" class="button primary mini" vendor-info='@json(['id'=>$list->id,
              'name'=>$list->name])' add-debit>Add</button>
              <button class="button primary mini">show</button>
            </td>
       			
       		</tr>
       		@endforeach
        </tbody>
    </table>
  </div>

 
</div>



