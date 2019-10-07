<div class="row">
    <div class="cell-md-12  text-right">

        <a class="button primary small" href="{{route('tariff.create')}}" style="color: #ffff;">Create Tarif</a>

    </div>
    <div class="cell-md-12">
    </div>
    <table class="table table-border row-border cell-border row-hover" id="peddingTable"
           custom-sortable="true"
    >
        <thead>


        <tr class="titleTr sortable-tr">
            <th class="sortable-column">#</th>
            <th class="sortable-column">show</th>
            <th class="sortable-column">name</th>
            <th class="sortable-column">records</th>
            <th class="sortable-column">use records</th>
            <th class="sortable-column">edit</th>
            <th class="sortable-column">remove</th>


        </tr>
        </thead>


@foreach($rowList as $list)
        <tr>
            <td>{{$list->id}}</td>
            <td>
                <a class="button small" href="{{route('tariff.show',['id'=>$list->id])}}" style="color: #ffff;">show Tarif</a>

            </td>
            <td>{{$list->name}}</td>
            <td>{{$list->rates->count()}}</td>
            <td>{{$list->customers->count()}}</td>
            <td>
                <a class="button small" href="{{route('tariff.edit',['id'=>$list->id])}}" style="color: #ffff;">edit</a>

            </td>
            <td>
                <a class="button small" href="{{route('tariff.remove',['id'=>$list->id])}}" style="color: #ffff;">remove</a>

            </td>

        </tr>
@endforeach


        <tbody>

        </tbody>
    </table>
</div>