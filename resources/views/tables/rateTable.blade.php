   <div class="row">
     <div class="cell-md-12  text-right">

    <a class="button primary small" href="{{route('rate.create')}}" style="color: #ffff;">add Rate</a>

     </div>
     <div class="cell-md-12">
   </div>
   <table class="table table-border row-border cell-border row-hover" id="peddingTable" 
custom-sortable="true"
   >
    <thead>
    <tr class="filterTr">
     
      <td colspan="3"><input data-find="fromRateSelect" type="text" data-role="input" data-prepend="From Rate: "></td>
      <td colspan="3"><input data-find="toRateSelect" type="text" data-role="input" data-prepend="To Rate: "></td>
    </tr>
    
    <tr class="titleTr sortable-tr">
        <th class="sortable-column">#</th>
        <th class="sortable-column">from Rate</th>
        <th class="sortable-column">To Rate</th>
        <th class="sortable-column">with Charge</th>
        <th class="sortable-column">Fee</th>
        <th class="sortable-column">CustomerRate</th>
      
    </tr>
    </thead>

       <tr>
           <td colspan="6" class="text-center">
               data not found
           </td>
       </tr>
  
    <tr v-for="(list,index) in {{$info->rowList}}">
      <td v-text="list.id"></td>
      <td v-text="list.localRate"></td>
      <td v-text="list.foreignMoney"></td>
      <td v-text="list.foreignWithFee"></td>
      <td v-text="list.fee"></td>
      <td v-text="list.exRate"></td>
    </tr>

  

    <tbody>
    
    </tbody>
</table>
</div>