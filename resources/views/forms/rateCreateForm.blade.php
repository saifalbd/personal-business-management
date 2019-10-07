
<form method="get" class="addRemoveForm" action="{{ route('rate.store',['tariffId'=>$info->id]) }}" accept-charset="UTF-8" style="padding: 100px;" data-role="validator">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="row pt-2 pb-2">
     <div class="cell-md-6 pt-2">
            <p>From Rate</p>
<input class="large" name="fromRate" type="number" data-role="input" data-validate="required"
id="fromRate">
        </div>
     
        <div class="cell-md-6 pt-2">
            <p>To Rate</p>
<input class="large" name="toRate" type="number" data-role="input" data-validate="required" 
id="toRate">
        </div>
<div class="cell-md-12 text-center" id="ShowRate">
    
</div>
       <div class="cell-md-12 pt-4 text-center">
        <button class="button primary">Large button</button>
    </div>
        

    </div>

</form>

@push('scriptsTop')
<script>

$('#fromRate,#toRate').keyup(function() {
   const fromRate = parseInt($('#fromRate').val());
   const toRate = parseInt($('#toRate').val()); 
   if (fromRate && toRate) {
    const amount = toRate + (toRate*0.02);
    const rate = amount/fromRate;
    $('#ShowRate').text(`with Charge ${amount} and rate : ${rate}`)
   }
})

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