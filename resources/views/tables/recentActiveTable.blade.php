
<div class="row">
    <div class="cell-md-12">

        <table class="table table-border row-border cell-border row-hover"
               custom-sortable="true"
               id="successTable"
        >
            <thead>


            <tr   class="sortable-tr titleTr">
                <th  class="sortable-column">#</th>
                <th class="sortable-column">Number</th>
                <th class="sortable-column">Type</th>
                <th class="sortable-column">Amount</th>
                <th class="sortable-column">Vendor</th>
                <th class="sortable-column">Customer</th>
                <th class="sortable-column">Date</th>
                <th>Remove</th>


            </tr>
            </thead>
            <tbody id="recentActiveTable">

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
                <td>

                    <button data-find="inactive" :data-value="list.id" data-role="inactive" class="button  mini
                    rounded"><span
                                class="mif-cross"></span> remove</button>
                </td>

            </tr>

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









</div>

