
<div class="row">
   
 
  <div class="cell-md-12">
    

    <table class="table table-border row-border cell-border row-hover" 
custom-sortable="true"
    >
        <thead>
        <tr class="sortable-tr titleTr">
            <th>#</th>
            <th class="sortable-column">Phone Number</th>
            <th class="sortable-column">Name</th>
            <th class="sortable-column">Total Due</th>
            <th class="sortable-column">Total Payment</th>
          
            <th class="sortable-column sort-asc">details</th>
           

        </tr>
        </thead>
        <tbody>
        	@foreach($rowList as $list)
       		<tr>
       			<td>{{$list->id}}</td>
            <td>
              <a href="{{route('customer.show',$list->id)}}">{{$list->phone}}</a>
            </td>
       			<td>{{$list->name}}</td>
       			<td>{{$list->RepayableDueTotal}}</td>
            <td>{{$list->RepayablePaymentTotal}}</td>

            <td>
              <a style="color:#ffff;" href="{{route('repayable.create',['customerid'=>$list->id])}}" class="button mini">add</a>
              <a style="color:#ffff;" href="{{route('customer.show',$list->id)}}" class="button mini">show profile</a>
            </td>

       		</tr>
       		@endforeach
        </tbody>
    </table>
  </div>
  
  <div class="cell-md-12 d-flex flex-justify-center">
         @component('others.pagination',['info'=>$rowList])
@endcomponent
   
  </div>
</div>

