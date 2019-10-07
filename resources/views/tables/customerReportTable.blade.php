<table class="table table-border row-border cell-border row-hover" id="orderReportTable"
       custom-sortable="true"
>
    <thead>
    <tr class="filterTr">
        <th colspan="6">
            @component('forms.reportCustomerForm',['route'=>'report.customer.filter'])
            @endcomponent
        </th>
    </tr>

    <tr class="sortable-tr titleTr">


        <th class="sortable-column">Name</th>
        <th class="sortable-column">Phone</th>
        <th class="sortable-column">Amount</th>
        <th class="sortable-column">Profit</th>
        <th class="sortable-column">bill</th>


    </tr>
    </thead>

    <tbody id="orderReportTableTbody">

    <tr v-for="(list,index) in {{$info->rowList->list}}">

        <td v-text="list.name"></td>


        <td v-text="list.phone"></td>
        <td>@{{list.amount|withSymbol('foreignSymbol')}}</td>

        <td>@{{list.profit|withSymbol('foreignSymbol')}}</td>

        <td>
            @{{list.bill|withSymbol('localSymbol')}}
        </td>

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
                        <tr class="titleTr">

                            <th colspan="2">Total profit</th>
                            <th>{{$info->rowList->sum->profit}}</th>
                        </tr>
                        <tr class="titleTr">

                            <th colspan="2">Total Bill</th>
                            <th>{{$info->rowList->sum->bill}}</th>
                        </tr>
                    </table>

                </div>
            </div>
        </th>
    </tr>
    </tfoot>
</table>













