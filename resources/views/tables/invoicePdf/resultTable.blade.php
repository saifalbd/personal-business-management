
@if(isset($info->pdf))
    <table style="border-color: #f5f5f5; border-width: 3px; width: 100%; border-style: solid;" border="3" cellspacing="0" cellpadding="0"><caption>&nbsp;</caption>

        @else
            <table class="table table-border row-border cell-border row-hover" id="peddingTable"
                   custom-sortable="true"
            >
                @endif

                <thead>
    <tr class="titleTr">
        <th colspan="5" >
            Account Info
        </th>
    </tr>
    <tr class="sortable-tr titleTr">
        <th colspan="1"></th>
        <th class="sortable-column">info Name</th>
        <th class="sortable-column">Values</th>


    </tr>
    </thead>
    {{-- @if($list->CommentTxt) data-role="hint" data-hint-text="{{$list->CommentTxt}}" @endif--}}
    <tbody id="peddingTableTbody">
    <tr >

        <td colspan="1"></td>
        <td>Total Order</td>
        <td>{{$info->orderPaymentRes->sum->amount}}</td>

    </tr>
    @if($info->vendor_id)
    <tr>
        <td colspan="1"></td>
            <td>Total Debit</td>
            <td>{{$info->DebitPaymentRes->sum->amount}}</td>

    </tr>
    @endif
    @if($info->customer_id)
        <tr>
            <td colspan="1"></td>
            <td>Total Dues</td>
            <td>{{$info->RepayableDuesRes->sum->amount}}</td>
        </tr>
    @endif

    <tr>
        <td colspan="1"></td>
        <td>Old sotck</td>
        <td>{{$info->stock}}</td>
    </tr>
    @if($info->vendor_id)
    <tr>
        <td colspan="1"></td>
        <td>total Paids</td>
        <td>{{$info->creditPaymentRes->sum->amount}}</td>
    </tr>
    @endif
    @if($info->customer_id)
        <tr>
            <td colspan="1"></td>
            <td>total Paids</td>
            <td>{{$info->RepayablePaidsRes->sum->amount}}</td>
        </tr>
    @endif


    @if($info->customer_id)
        <tr>
            <td colspan="1"></td>
            <td>myalance</td>

            <td>
{{$info->Balance}}
            </td>

        </tr>
    @endif

    </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3">
amamam
                        </td>
                    </tr>
                </tfoot>
</table>
