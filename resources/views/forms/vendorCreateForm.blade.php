
<form method="post" class="addRemoveForm" action="{{ route('vendor.store') }}" accept-charset="UTF-8" style=" padding: 100px;">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="row pt-2 pb-2">
     <div class="cell-md-12 pt-2">
            <p>Vendor Name</p>
<input class="large" name="vendorName" type="text" data-role="input">
        </div>
        <div class="cell-md-6 pt-2">

            <p>Vendor Type</p>
            <select data-role="select" name="vendorType">
    <option value="online" data-template="<span class='mif-user icon'></span> $1">online</option>
    <option value="manual" data-template="<span class='mif-user icon'></span> $1">Manual</option>
    
    
</select>
        </div>
        <div class="cell-md-6 pt-2">
            <p>Request Type</p>
                   <select data-role="select" name="vendorRate">
    <option value="23" data-template="<span class='mif-mobile icon'></span> $1">23</option>
    <option value="22.70" data-template="<span class='mif-mobile icon'></span> $1">22.70</option>
    
</select>
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