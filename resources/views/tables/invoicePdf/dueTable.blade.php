<table style="border-color: #f5f5f5; border-width: 3px; width: 100%; border-style: solid;" border="3" cellspacing="0" cellpadding="0"><caption>&nbsp;</caption>
    <caption>Due List</caption>
    <tbody>
    <tr>
        <th>Serial</th>
        <th>Amount</th>
        <th>Comment</th>
        <th>Date</th>
    </tr>
    @foreach($info->RepayableDuesRes->list::obj() as $list)
    <tr>
        <td>{{$list->_uid}}</td>
        <td>{{$list->amount}}</td>
        <td>{{$list->comment}}</td>
        <td>{{$list->date}}</td>

    </tr>
        @endforeach
    </tbody>
    <tfoot>
    <th colspan="2">total</th>
    <th>{{$info->RepayableDuesRes->sum->amount}}</th>
    <th colspan="2"></th>
    </tfoot>
</table>