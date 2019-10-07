<div class="grid">
    <form class="row " data-role="validator"
          method="get"
          action="{{route($route)}}">

        <div class="cell-md-5 mini-input">
            <p>
                from
            </p>
            <input type="text" data-role="calendarpicker" name="fromDate" value="{{input('fromDate')}}">
        </div>
        <div class="cell-md-5 mini-input">
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