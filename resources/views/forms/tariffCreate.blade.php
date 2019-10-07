
<form method="get" class="addRemoveForm" action="{{ route('tariff.store') }}" accept-charset="UTF-8" style="padding: 100px;" data-role="validator">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="row pt-2 pb-2">
        <div class="cell-md-12 pt-2">
            <p>new Tarif Name</p>
            <input class="large" name="tarifName" type="text" data-role="input" data-validate="required"
                  >
        </div>

        <div class="cell-md-12 pt-2">
            <p>Import Tarif</p>
            <select data-role="select" name="importId">
                <option value="" data-template="<span class='mif-user icon'></span> $1">select Optional</option>

            @foreach($tariffList as $list)
                    <option value="{{$list->id}}" data-template="<span class='mif-user icon'></span> $1">{{$list->name}}</option>


                @endforeach
            </select>
        </div>

        <div class="cell-md-12 pt-4 text-center">
            <button class="button primary">Submit</button>
        </div>


    </div>

</form>
