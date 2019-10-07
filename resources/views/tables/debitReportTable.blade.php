   <table class="table table-border row-border cell-border row-hover" id="orderReportTable" 
custom-sortable="true"
   >
    <thead>
    <tr class="filterTr">
      <th colspan="6">
          @component('forms.reportFinderForm',['route'=>'report.debit.filter','info'=>$info])
          @endcomponent

        </th>
    </tr>
    <tr class="sortable-tr titleTr">
        <th class="sortable-column">#</th>
        
        <th class="sortable-column">Amount</th>
      
        <th class="sortable-column">Vendor</th>
       
        <th class="sortable-column">date</th>
        

    </tr>
    </thead>

    <tbody id="orderReportTableTbody">
     
  
      <tr  v-for="(list,index) in {{$info->rowList->list}}"
  v-bind:data-role="[list.comment?'hint':null]"
  v-bind:data-hint-text="[list.comment?list.comment:null]"

        >
        <td v-text="list._uid"></td>
          <td>@{{list.amount|withSymbol('foreignSymbol')}}</td>
        <td v-text="list.vendorName"></td>
        <td v-text="list.date"></td>
   
    
      </tr>
    
    	
    </tbody>
    <tfoot>
    <tr class="titleTr">
        <th class="text-center" colspan="2">
            {{dateToWord(input('fromDate'))}}
        </th>
        <th class="text-center">To</th>
        <th class="text-center" colspan="2">
            {{dateToWord(input('toDate'))}}
        </th>
    </tr>
     <tr class="titleTr">
       <th colspan="6">
         
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




})



</script>

@endpush