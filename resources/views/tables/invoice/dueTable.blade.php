

<table class="table table-border row-border cell-border row-hover" id="peddingTable"
       custom-sortable="true"
       @if(isset($info->pdf))
       style="width: 100%;" border="1" cellpadding="5" @endif>
    <thead>
    <tr class="titleTr">
        <th colspan="6" >
            Due List
        </th>
    </tr>
    <tr class="sortable-tr titleTr">
        <th >#</th>


        <th class="sortable-column">type</th>
        <th class="sortable-column">Amount</th>
        <th class="sortable-column">comment</th>
        <th class="sortable-column">date</th>
        @if(!isset($info->pdf))
        <th class="">Button</th>
        @endif

    </tr>
    </thead>
    {{-- @if($list->CommentTxt) data-role="hint" data-hint-text="{{$list->CommentTxt}}" @endif--}}
    <tbody id="peddingTableTbody">
    @if(isset($info->pdf))

        @foreach($info->orderPaymentRes->list as $item)
            @php
            $i = $item->toArray('');
            @endphp

            <tr>

                <td>{{$i['_uid']}}</td>
                <td>{{$i['orderNumber']}}</td>
                <td>{{$i['amount']}}</td>
                <td>{{$i['comment']}}</td>
                <td>{{$i['date']}}</td>


            </tr>

        @endforeach

    @else
    <tr v-for="(list ,index) in {{$info->repayableDuesRes->list->toJson()}}" :tabindex="list.id">

        <td
                clickThenCopy = "true"
                data-role="hint"
                data-hint-position="right"
                data-hint-text="click then do copy"
                :data-txt = "'serial:'+list._uid"
        >@{{list._uid}}</td>


        <td>@{{list.type}}</td>
        <td>@{{list.amount}}</td>

        <td>@{{list.comment}}</td>
        <td><small>@{{list.date}}</small></td>
        <td>

            @if(!$info->publish)
                <a class="button warning" :href="list.pullUrl" >remove</a>
            @endif
        </td>



    </tr>
        @endif

    </tbody>
    <tfoot>
    <tr class="titleTr">
        <th colspan="9">

            <div class="row">
                <div class="cell-md-6 offset-md-3" >
                    <table class="table">
                        <tr class="titleTr">

                            <th colspan="2">Total Amount</th>
                            <th>{{$info->repayableDuesRes->sum->amount}}</th>
                        </tr>

                    </table>

                </div>
            </div>
        </th>
    </tr>
    </tfoot>
</table>




