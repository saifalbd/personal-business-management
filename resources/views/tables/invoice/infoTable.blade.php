<table class="table table-border row-border cell-border row-hover" id="peddingTable"
       custom-sortable="true"
>
    <thead>
    <tr class="titleTr">
        <th colspan="5" >
            InfoVoice Info
        </th>
    </tr>
    <tr class="sortable-tr titleTr">
        <th colspan="3"></th>
        <th class="sortable-column">info Name</th>
        <th class="sortable-column">Values</th>


    </tr>
    </thead>
    {{-- @if($list->CommentTxt) data-role="hint" data-hint-text="{{$list->CommentTxt}}" @endif--}}
    <tbody id="peddingTableTbody">
    <tr >

        <td colspan="3"></td>
        <td>Invoice ID</td>
        <td>{{$info->invoice_id}}</td>

    </tr>
    <tr>
        <td colspan="3"></td>
        @if($info->vendor_id)
        <td>Reciver Name</td>
        <td>{{$info->vendor->name}}</td>
            @endif
        @if($info->customer_id)
            <td>Reciver Name</td>
            <td>{{$info->customer->name}}</td>
        @endif
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>Old sotck</td>
        <td>{{$info->stock}}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>status</td>
        <td>{{$info->status}}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>Show Pdf</td>
        <td>
            <a class="button" href="{{route('invoice.pdf',['type'=>$info->parent['type'],'id'=>$info->id])}}">show Pdf</a>

        </td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>Back</td>
        <td>
            @if($info->canCustomer)
            <a class="button" href="{{route('customer.show',$info->customer->id)}}">Back</a>
                @endif
                @if($info->canVendor)
                    <a class="button" href="{{route('vendor.show',$info->vendor->id)}}">Back</a>
                @endif
        </td>
    </tr>




    </tbody>
    <tfoot>

    </tfoot>
</table>
