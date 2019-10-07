
<div class="row">
    <div class="cell-md-12 text-right">
    <a class="button primary small" href="{{route('customer.create')}}" style="color: #ffff;">add Customer</a>
  </div>
 
  <div class="cell-md-12">

    <table class="table table-border row-border cell-border row-hover" 
    custom-sortable="true">
        <thead>
      <tr  class="filterTr">
          <th colspan="8">
          <div class="grid">
            <form class="row " data-role="validator"
            method="get"
             action="{{route('customer.filter')}}">
              
                <div class="cell-md-5">
    <input type="text" data-role="input"  name="customerName" data-prepend="customer Name: " 
    value="{{input('customerName')}}">
                </div>
            
                <div class="cell-md-5">
      <input type="text" data-role="input"  name="customerNumber"  data-prepend="customer Number: " 
      value="{{input('customerNumber')}}">
                </div>
                <div class="cell-md-2">
                  <button class="button primary">submit</button>
                </div>
            </form>
          </div>
        </th>
        
      </tr>
    
         <tr class="sortable-tr titleTr">
            <th class="sortable-column">#</th>
            <th class="sortable-column">Phone Number</th>
            <th class="sortable-column">Name</th>
             <th class="sortable-column">Tariff</th>
            <th class="sortable-column">Count Number</th>
            <th class="sortable-column">pay Count</th>
            <th class="sortable-column">Total Amount</th>
            <th class="sortable-column">details</th>
           

        </tr>
        </thead>
        <tbody>
        	
       		<tr v-for="(list,index)  in {{$info->rowList->list}}">
       			<td v-text="list.id"></td>
            <td>
              <a :href="list.show.url" v-text="list.phoneNumber"></a> 
            </td>
       			<td v-text="list.name"></td>
                <td v-text="list.tariffName"></td>

       			<td v-text="list.orderCount"></td> 
            <td v-text="list.paymentCount"></td>
       			<td v-text="list.paymentSum"></td>
            <td>
              <a style="color:#ffff;" :href="list.show.url" class="button  mini" v-text="list.show.txt"></a>
            </td>
       		
       		</tr>
       		
        </tbody>
    </table>
  </div>
  
 <div class="container pagination-box">

 {!!$info->rowList->paginationHtml!!}

</div>
</div>

