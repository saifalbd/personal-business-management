<div class="row">
    <div class="cell-md-12  text-right">

        <a class="button primary small" href="{{route('rate.create',['tariffId'=>$info->id])}}" style="color: #ffff;">add Rate</a>

    </div>
    <div class="cell-md-12">
    </div>
    <table class="table table-border row-border cell-border row-hover" id="peddingTable"
           custom-sortable="true"
    >
        <thead>
        <tr class="filterTr">

            <td colspan="4"><input data-find="fromRateSelect" type="text" data-role="input" data-prepend="From Rate: "></td>
            <td colspan="4"><input data-find="toRateSelect" type="text" data-role="input" data-prepend="To Rate: "></td>
        </tr>

        <tr class="titleTr sortable-tr">
            <th class="sortable-column">#</th>
            <th class="sortable-column">from Rate</th>
            <th class="sortable-column">To Rate</th>
            <th class="sortable-column">with Charge</th>
            <th class="sortable-column">Fee</th>
            <th class="sortable-column">CustomerRate</th>
            <th>edit</th>
            <th>remove</th>

        </tr>
        </thead>


        <tr v-for="(list,index) in {{$info->ratesRes->list}}">
            <td v-text="list.id"></td>
            <td :text-content.prop="list.localRate| withSymbol('localSymbol')"></td>
            <td :text-content.prop="list.foreignMoney| withSymbol('foreignSymbol')"></td>
            <td :text-content.prop="list.foreignWithFee| withSymbol('foreignSymbol')"></td>

            <td :text-content.prop="list.fee| withSymbol('foreignSymbol')"></td>
            <td :text-content.prop="list.exRate| withSymbol('foreignSymbol')"></td>

            <td><a class="button small"  :href="list.editUrl">edit</a></td>
            <td><a class="button small"  :href="list.removeUrl">remove</a></td>
        </tr>



        <tbody>

        </tbody>
    </table>
</div>