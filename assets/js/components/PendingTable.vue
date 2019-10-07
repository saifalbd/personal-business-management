<table class="table table-border row-border cell-border row-hover" id="peddingTable"
       custom-sortable="true"
>
    <thead>



    <tr class="sortable-tr titleTr">
        <th >
            <input id="filterClick" type="checkbox" data-role="checkbox" >
        </th>
        <th class="sortable-column">Number</th>
        <th class="sortable-column">type</th>
        <th class="sortable-column">Amount</th>
        <th class="sortable-column">bill</th>
        <th class="sortable-column">Vendor</th>
        <th class="sortable-column">Customer</th>
        <th class="sortable-column">Phone</th>
        <th class="sortable-column">date</th>

        <th class="">Button</th>

    </tr>
    </thead>

    <tbody id="peddingTableTbody">
    <tr v-for="(list ,index) in data" :tabindex="list.id"


    >
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
        <td style="min-width: 100px">@{{list.bill|withSymbol('localSymbol')}}</td>

        <td>@{{list.vendor}}</td>
        <td
                clickThenCopy = "true"
                data-role="hint"
                data-hint-position="right"
                data-hint-text="click then do copy"
                :data-txt = "list.customer">@{{list.customer}}</td>
        <td>@{{list.phone}}</td>
        <td><small>@{{list.createdTxt}}</small></td>

        <td style="padding:2px 2px; min-width:100px;  ">
            <button data-find="active" :data-value="list.id" data-role="active" class="button  mini rounded"><span
                    class="mif-done"></span></button>

            <div class="dropdown-button" style="height: 20px;">
                <button class="button mini rounded"><span class="mif-embed2"></span></button>
                <ul class="d-menu" data-role="dropdown">
                    <li
                            v-for="(item,index) in list.dropdown"
                    >
                        <a :href="item.url" v-text="item.txt"></a>
                    </li>

                </ul>
            </div>



        </td>
    </tr>

    </tbody>
    <tfoot>
    <tr class="titleTr">
        <th colspan="10">

            <div class="row">
                <div class="cell-md-6 offset-md-3" >
                    <table class="table">
                        <tr class="titleTr">

                            <th colspan="2">Total Amount</th>
                            <th></th>
                        </tr>

                    </table>

                </div>
            </div>
        </th>
    </tr>
    </tfoot>
</table>

<script>
    export default {
        props:{
            data: Object,
        },
        computed:{

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
