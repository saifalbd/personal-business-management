<table class="table table-border row-border cell-border row-hover" id="peddingTable"
       custom-sortable="true"
>
    <thead>
    <tr class="titleTr">
        <th colspan="5" >
            Paids List
        </th>
    </tr>
    <tr class="sortable-tr titleTr">
        <th >#</th>


        <th class="sortable-column">Amount</th>
        <th class="sortable-column">Comment</th>
        <th class="sortable-column">date</th>

        <th class="">Button</th>

    </tr>
    </thead>
    {{-- @if($list->CommentTxt) data-role="hint" data-hint-text="{{$list->CommentTxt}}" @endif--}}
    <tbody id="peddingTableTbody">
    <tr v-for="(list ,index) in {{$info->repayablePaidsRes->list->toJson()}}" :tabindex="list.id">

        <td
                clickThenCopy = "true"
                data-role="hint"
                data-hint-position="right"
                data-hint-text="click then do copy"
                :data-txt = "'serial:'+list._uid"
        >@{{list._uid}}</td>


        <td>@{{list.amount}}</td>
        <td>@{{list.comment}}</td>

        <td><small>@{{list.date}}</small></td>
        <td>

            @if(!$info->publish)
                <a class="button warning" :href="list.pullUrl" >remove</a>
            @endif
        </td>


    </tr>

    </tbody>
    <tfoot>
    <tr class="titleTr">
        <th colspan="5">

            <div class="row">
                <div class="cell-md-6 offset-md-3" >
                    <table class="table">
                        <tr class="titleTr">

                            <th colspan="2">Total Amount</th>
                            <th>{{$info->repayablePaidsRes->sum->amount}}</th>
                        </tr>

                    </table>

                </div>
            </div>
        </th>
    </tr>
    </tfoot>
</table>




