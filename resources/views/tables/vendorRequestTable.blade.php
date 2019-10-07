
<div class="row">

  <div class="cell-md-12">
    
    <table class="table table-border row-border cell-border row-hover" 
 custom-sortable="true" 
    >
    
        <thead>

       <tr  class="titleTr">
          <th colspan="7">
             Request List
          </th>
        </tr>
      <tr class="filterTr">
        <th colspan="7">
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
        </th>
      </tr>
    
        <tr class="sortable-tr titleTr">
            <th class="sortable-column sort-asc">#</th>
            <th class="sortable-column sort-asc">Number</th>
            <th class="sortable-column sort-asc">Amount</th>
            <th class="sortable-column sort-asc">Vendor</th>
            <th class="sortable-column sort-asc">Customer</th>
            <th class="sortable-column sort-asc">Date</th>
            <th class="sortable-column sort-asc">invoice</th>

        </tr>
        </thead>
        <tbody>
     
          <tr v-for="(list,index) in {{$info->orderPayment->list}}" :key="index">
            <td clickThenCopy = "true"
                data-role="hint"
                data-hint-position="right"
                data-hint-text="click then do copy"
                :data-txt = "'serial:'+list.id"  v-text="list._uid"></td>
            <td  clickThenCopy = "true"
                 data-role="hint"
                 data-hint-position="right"
                 data-hint-text="click then do copy"
                 :data-txt = "list.orderNumber" v-text="list.orderNumber"></td>
              <td>@{{list.amount|withSymbol('foreignSymbol')}}</td>
            <td>{{$info->name}}</td>
            <td v-text="list.customerName"></td>
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
            <th colspan="5">{{$info->orderPayment->sum->amount}}</th>
            
          </tr>
        </tfoot>
    </table>
  </div>
<!--end -Table cell-->
<!--start -Table cell-->
<div class="cell-md-12">
    <table class="table table-border row-border cell-border row-hover">
    
        <thead>
        <tr  class="titleTr">
          <th colspan="6">
             Credit List
          </th>
        </tr>
        <tr class="filterTr">
          <td colspan="2">
         <p>To Date</p>
        <input data-role="datepicker" data-value="Mon, 25 Dec 1995">
          </td>
          <td colspan="2">
         <p>To Date</p>
        <input data-role="datepicker" data-value="Mon, 25 Dec 1995"> 
          </td>
          <td colspan="2" class="text-center">
            <p>find on Select Date</p>
            <div class="text-center">
               <button class="button primary">Aplay</button>
            </div>
                    
          </td>
        </tr>
        <tr  class="sortable-tr titleTr">
            <th class="sortable-column sort-asc">#</th>
            <th class="sortable-column sort-asc">Amount</th>
            <th class="sortable-column sort-asc">Vendor</th>
            <th class="sortable-column sort-asc">comments</th>
            <th class="sortable-column sort-asc">Date</th>
            <th class="sortable-column sort-asc">invoice</th>

        </tr>
        </thead>
        <tbody>
      
          <tr v-for="(list,index) in {{$info->vendorCreditPayment->list}}" :key="index">
            <td v-text="list._uid"></td>
              <td>@{{list.amount|withSymbol('foreignSymbol')}}</td>
            <td>{{$info->name}}</td>
            <td v-text="list.comment"></td>
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
          <th colspan="3">{{$info->vendorCreditPayment->sum->amount}}</th>
              <th>
                  <button id="vendorCreditAdd" class="button primary mini" vendor-info='@json(['id'=>$info->id,
              'name'=>$info->name])'
                          add-cradit>Add Credit</button>
              </th>
            
          </tr>
        </tfoot>
    </table>  
</div>
<!--end -Table cell-->

<!--start -Table cell-->
<div class="cell-md-12">
    <table class="table table-border row-border cell-border row-hover"
    custom-sortable="true">
    
        <thead>
        <tr  class="titleTr">
          <th colspan="6">
             Debit List
          </th>
        </tr>
        <tr class="filterTr">
          <td colspan="3">
         <p>To Date</p>
        <input data-role="datepicker" data-value="Mon, 25 Dec 1995">
          </td>
          <td colspan="2">
         <p>To Date</p>
        <input data-role="datepicker" data-value="Mon, 25 Dec 1995"> 
          </td>
          <td class="text-center">
            <p>find on Select Date</p>
            <div class="text-center">
               <button class="button">Aplay</button>
            </div>
                    
          </td>
        </tr>
        <tr class="sortable-tr titleTr">
            <th class="sortable-column sort-asc">#</th>
            <th class="sortable-column sort-asc">Amount</th>
            <th class="sortable-column sort-asc">Vendor</th>
            <th class="sortable-column sort-asc">Comment</th>
            <th class="sortable-column sort-asc">Date</th>
            <th class="sortable-column sort-asc">invoice</th>

        </tr>
        </thead>
        <tbody>
     
          <tr v-for="(list,index) in {{$info->vendorDebitPayment->list}}" :key="index">
            <td
                    clickThenCopy = "true"
                    data-role="hint"
                    data-hint-position="right"
                    data-hint-text="click then do copy"
                    :data-txt = "'serial:'+list._uid"
                    v-text="list._uid"></td>
              <td>@{{list.amount|withSymbol('foreignSymbol')}}</td>
            <td>{{$info->name}}</td>
            <td v-text="list.comment"></td>
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
           <th colspan="3">{{$info->vendorDebitPayment->sum->amount}}</th>
              <th>
                  <button  id="vendorDebitAdd" class="button primary mini" vendor-info='@json(['id'=>$info->id,
              'name'=>$info->name])' add-debit>Add Debit</button>
              </th>
            
          </tr>
        </tfoot>
    </table>  
</div>
<!--end -Table cell-->

  <div class="cell-md-12 d-flex flex-justify-center">
     
  
  </div>
</div>



