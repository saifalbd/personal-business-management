
<div class="row">
  <div class="cell-md-12">
  
  </div>

  <div class="cell-md-12">
    
    <table 
    class="table table-border row-border cell-border row-hover"
    custom-sortable="true">
    
        <thead>
        <tr class="titleTr">
          <th colspan="6" >
             Request List
          </th>
        </tr>
        <tr class="filterTr">
          <td colspan="6">
                <div class="grid">
            <form class="row " data-role="validator"
            method="get"
             action="{{route('history.success.search')}}">
              
                <div class="cell-md-5">
      <input type="text" data-role="calendarpicker" name="fromDate" data-prepend="from: "> 
                </div>
                <div class="cell-md-5">
      <input type="text" data-role="calendarpicker"  name="toDate" data-prepend="To: ">
                </div>
                <div class="cell-md-2">
                  <button class="button primary">submit</button>
                </div>
            </form>
          </div>
          </td>
        </tr>
        <tr  class="sortable-tr titleTr">
            <th>#</th>
            <th class="sortable-column">Number</th>
            <th class="sortable-column">Amount</th>
            <th class="sortable-column">Vendor</th>
            <th class="sortable-column">Date</th>
            <td class="sortable-column">invoice</td>

        </tr>
        </thead>
        <tbody>
         
          <tr v-for="(list,index) in {{$info->payments->list}}" :key="index">
            <td v-text="list._uid"></td>
            <td v-text="list.orderNumber"></td>
            <td :text-content.prop="list.amount| withSymbol('foreignSymbol')"></td>
            <td v-text="list.vendorName"></td>
<td><small v-text="list.date"></small></td>
              <td>

                  <a class="button warning" v-if="list.invoiceStatus=='pending'" v-text="list.invoiceStatus"></a>
                  <a class="button error" v-if="list.invoiceStatus=='close'" v-text="list.invoiceStatus"></a>
                  <a  class="button primary" :href="list.pushUrl" v-if="list.invoiceStatus=='push'" v-text="list.invoiceStatus"></a>
              </td>
          </tr>
         
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2">Total Amount</th>
            <th colspan="4">{{$info->payments->sum->amount}}</th>
            
          </tr>
        </tfoot>
    </table>
  </div>




  <!--end table cell-->
   <div class="cell-md-12">
    
    <table class="table table-border row-border cell-border row-hover"
    custom-sortable="true">
    
        <thead>
        <tr class="titleTr">
          <th colspan="7">
             Dues  List
          </th>
        </tr>
        <tr class="filterTr">
          <td colspan="3">
         <p>From Date</p>
        <input data-role="datepicker" data-value="Mon, 25 Dec 1995">
          </td>
          <td colspan="2">
         <p>To Date</p>
        <input data-role="datepicker" data-value="Mon, 25 Dec 1995"> 
          </td>
          <td class="text-center">
            <p>find on Select Date</p>
            <div class="text-center">
               <button class="button primary">Aplay</button>
            </div>
                    
          </td>
        </tr>
        <tr class="sortable-tr">
            <th class="sortable-column sort-asc">#</th>
            <th class="sortable-column sort-asc">Type</th>
            <th class="sortable-column sort-asc">Amount</th>
            <th class="sortable-column sort-asc">comment</th>
            <th class="sortable-column sort-asc">Date</th>
            <td class="sortable-column sort-asc">invoice</td>
        </tr>
        </thead>
        <tbody>
          <tr v-for="(list,index) in {{$info->repayableDues->list}}" :key="index">
            <td v-text="list._uid"></td>
            <td   v-text="list.dueType"></td>
              <td :text-content.prop="list.dueAmount| withSymbol('foreignSymbol')"></td>

              <td v-text="list.commentTxt"></td>
<td><small  v-text="list.date"></small></td>
              <td>

                  <a class="button warning" v-if="list.invoiceStatus=='pending'" v-text="list.invoiceStatus"></a>
                  <a class="button error" v-if="list.invoiceStatus=='close'" v-text="list.invoiceStatus"></a>
                  <a  class="button primary" :href="list.pushUrl" v-if="list.invoiceStatus=='push'" v-text="list.invoiceStatus"></a>
              </td>
          </tr>
         
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2">Total Amount</th>
            <th colspan="5">{{$info->repayableDues->sum->dueAmount}}</th>
            
          </tr>
        </tfoot>
    </table>
  </div>
  <!--end table cell-->

    <!--end table cell-->
   <div class="cell-md-12">
    
    <table class="table table-border row-border cell-border row-hover"
    custom-sortable="true">
    
        <thead>
        <tr class="titleTr">
          <th colspan="7">
             Payments List
          </th>
        </tr>
        <tr  class="filterTr">
          <td colspan="2">
         <p>To Date</p>
        <input data-role="datepicker" data-value="Mon, 25 Dec 1995">
          </td>
          <td colspan="3">
         <p>To Date</p>
        <input data-role="datepicker" data-value="Mon, 25 Dec 1995"> 
          </td>
          <td class="text-center">
            <p>find on Select Date</p>
            <div class="text-center">
               <button class="button primary">Aplay</button>
            </div>
                    
          </td>
        </tr>
        <tr  class="sortable-tr">
            <th class="sortable-column sort-asc">#</th>
            <th class="sortable-column sort-asc">Type</th>
            <th class="sortable-column sort-asc">Amount</th>
            <th class="sortable-column sort-asc">comment</th>
            <th class="sortable-column sort-asc">Date</th>
            <td class="sortable-column sort-asc">invoice</td>

        </tr>
        </thead>
        <tbody>
       
          <tr v-for="(list,index) in {{$info->repayablePayments->list}}" :key="index">
            <td v-text="list._uid"></td>
            <td v-text="list.orderType"></td>
            <td v-text="list.amount"></td>
            <td v-text="list.commentTxt"></td>
<td><small  v-text="list.date"></small></td>
              <td>

                  <a class="button warning" v-if="list.invoiceStatus=='pending'" v-text="list.invoiceStatus"></a>
                  <a class="button error" v-if="list.invoiceStatus=='close'" v-text="list.invoiceStatus"></a>
                  <a  class="button primary" :href="list.pushUrl" v-if="list.invoiceStatus=='push'" v-text="list.invoiceStatus"></a>
              </td>

          </tr>
          
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2">Total Amount</th>
            <th colspan="5">{{$info->repayablePayments->sum->amount}}</th>
            
          </tr>
        </tfoot>
    </table>
  </div>
  <!--end table cell-->

 <div class="cell-md-12">
    
    <table class="table table-border row-border cell-border row-hover"
       custom-sortable="true">
    
        <thead>
        <tr  class="titleTr">
          <th colspan="4">
             Request Name Relation List
          </th>
        </tr>

        <tr  class="sortable-tr">
            
            <th class="sortable-column sort-asc">number</th>
            <th class="sortable-column sort-asc">Name</th>
            <th class="sortable-column sort-asc">Phone</th>
            <th class="sortable-column sort-asc">pay Count</th>

        </tr>
        </thead>
        <tbody>
         
          <template  v-for="item in {{$info->ordersRelation->list}}" >
          <tr v-for="list in item.customers" >

            <td v-text="item.orderNumber"></td>
            <td v-text="list.customerName"></td>
            <td v-text="list.phoneNumber"></td>
            <td v-text="list.count"></td>

          </tr>

         </template>
        </tbody>
      
    </table>
  </div>
 
</div>



