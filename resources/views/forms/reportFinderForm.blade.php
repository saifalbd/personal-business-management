<div class="grid">
    <form class="row " data-role="validator"
          method="get"
          action="{{route($route)}}">

        <div class="cell-md-2 cell-sm-2 mini-input">
            <p>
                Serial From
            </p>
            <input type="number" data-role="input" name="serialFrom" value="{{ input('serialFrom') }}" placeholder="Serial From">
        </div>
        <div class="cell-md-2  cell-sm-2  mini-input">
            <p>
                Serial To
            </p>
            <input type="number" data-role="input" name="serialTo" value="{{ input('serialTo') }}" placeholder="Serial To">
        </div>
        @if(isset($info->vendorDrops))
        <div class="cell-md-2 mini-input">
            <p>
                Select Vendor
            </p>
            <select data-role="select" name="vendorid" value="{{ input('vendorid') }}"  data-find="vendorSelect">
                <option  data-template="<span class='mif-amazon icon'></span> $1" value="">Select Vendor</option>
                @foreach($info->vendorDrops as $vendor)
                    <option value="{{$vendor->id}}" {{isEqual([$vendor->id,input('vendorid')],'selected')}} data-template="<span class='mif-amazon icon'></span> $1">{{$vendor->name}}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="cell-md-2 mini-input">
            <p>
                from
            </p>
            <input type="text" data-role="calendarpicker" name="fromDate" value="{{input('fromDate')}}">
        </div>
        <div class="cell-md-2 mini-input">
            <p>
                To
            </p>
            <input type="text" data-role="calendarpicker"  name="toDate" value="{{input('toDate')}}">
        </div>
        <div class="cell-md-2 mini-input text-center">
            <p>Aplay</p>
            <button class="button primary">submit</button>
        </div>
    </form>
</div>