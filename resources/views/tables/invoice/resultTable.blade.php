<table class="table table-border row-border cell-border row-hover" id="peddingTable"
       custom-sortable="true"
>
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
        <td>{{$info->orderPaymentRes->sum->bill}}</td>

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

    @if(!$info->publish)
    <tr>
        <td colspan="1"></td>
        <td>Old sotck</td>
        <td>{{$info->OldStock}}</td>
    </tr>
    @endif
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
            <td>{{$info->Balance}}</td>
        </tr>
    @endif
    @if($info->vendor_id)
        <tr>
            <td colspan="1"></td>
            <td>myalance</td>
            <td>{{$info->Balance}}</td>
        </tr>
    @endif


    @if(!$info->publish)
        <tr>
            <td colspan="5">
                <form method="post" class="addRemoveForm" action="{{ route('invoice.publish')
                 }}" accept-charset="UTF-8" style="padding: 25px 100px;" data-role="validator">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="invoiceId" value="{{$info->id}}">
                    <input type="hidden" name="balance" value="{{$info->Balance}}">

                            <button class="button primary">Publish</button>


                </form>


            </td>

        </tr>
        @endif





    </tbody>

</table>
