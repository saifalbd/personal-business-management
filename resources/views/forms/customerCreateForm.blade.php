
    <form method="post" class="addRemoveForm" action="{{ route('customer.store') }}" accept-charset="UTF-8" style="padding: 100px;">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="row pt-2 pb-2">
     <div class="cell-md-6 pt-2">
            <p>Customer Name</p>
    
<input class="large" name="customerName" type="text" data-role="input">
        </div>
     <div class="cell-md-6 pt-2">
            <p>Customer Phone</p>
<input class="large" name="customerPhone" type="number" data-role="input">
        </div>
        <div class="cell-md-6 pt-2">

            <p>city Name</p>
    <input class="large" name="cityName" type="text" data-role="input">
        </div>
      <div class="cell-md-6 pt-2">

          <p>Select Tarif</p>
          <select
                  data-role="select"
                  name="tariffId"
                  data-validate="required"
          >
              @foreach($info->tariffList as $list)
                  <option value="{{$list->id}}" data-template="<span class='mif-mobile icon'></span> $1"
                          @if($list->id ==1) selected @endif
                  >
                      {{$list->name}}
                  </option>

              @endforeach
          </select>

      </div>


      <div class="cell-md-12 pt-2">
            <p>discription</p>
     <input class="large" name="description" type="text" data-role="input">
        </div>





       <div class="cell-md-12 pt-4 text-center">
    
        <button class="button primary">Large button</button>
    </div>
        

    </div>

</form>

@push('scriptsTop')
<script>
    var requestNumber = [
        {
            html: "<span class='mif-zoom-in'></span>",
            cls: "alert",
            onclick: "alert('You press user button')"
        },
       
    ]
    var requestNumberConfrim = [
        {
            html: "<span class='mif-zoom-in'></span>",
            cls: "alert",
            onclick: "alert('You press user button')"
        },
        {
            html: "<span class='mif-copy'></span>",
            cls: "info",
            onclick: "alert('You press user button')"
        },
       
    ]

</script>

@endpush