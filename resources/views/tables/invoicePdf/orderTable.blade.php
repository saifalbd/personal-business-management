<table style="border-color: #f5f5f5; border-width: 3px; width: 100%; border-style: solid;" border="3" cellspacing="0" cellpadding="0"><caption>&nbsp;</caption>
<caption>order List</caption>
    <tbody>
    <tr>
        <th>Serial</th>
        <th>Number</th>
        <th>Amount</th>
        @if($info->canCustomer)
        <th>bill</th>
        @endif;
        <th>Comment</th>
        <th>Date</th>
    </tr>
    @foreach($info->orderPaymentRes->list::obj() as $list)
    <tr>
        <td>{{$list->_uid}}</td>
        <td>{{$list->orderNumber}}</td>
        <td>{{$list->amount}}</td>
        @if($info->canCustomer)
        <td>{{$list->bill}}</td>
        @endif;
        <td>{{$list->comment}}</td>
        <td>{{$list->date}}</td>
    </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="2">total</th>
        <th>{{$info->orderPaymentRes->sum->amount}}</th>
        @if($info->canCustomer)
        <th>{{$info->orderPaymentRes->sum->bill}}</th>
            @else
            <th></th>
        @endif;
        <th colspan="1"></th>
    </tr>
    </tfoot>
</table>
