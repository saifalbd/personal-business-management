
<form method="get"  action="{{ route('invoice.genarate') }}" accept-charset="UTF-8" >
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="parent" value="{{$parent}}">
    <input type="hidden" name="_id" value="{{$_id}}">
    <button type="submit">Genarate</button>

</form>