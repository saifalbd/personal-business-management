<div data-role="charms" class="p-0" data-position="left" id="specific-charms">
    @if(isset($leftMenu))
        @component('menus.dataFindList', ['leftMenu'=>$leftMenu])
        @endcomponent
    @endif
</div>


<div data-role="charms" class="p-0" data-position="left" id="charms-right">
    @component('menus.dataRateList')
    @endcomponent
</div>
<div data-role="charms" class="p-0" data-position="bottom" id="charms-bottom">
    <div class="container-fluid">
        <!-- content here -->
        <div class="grid">
            <div class="row">
                <div class="cell cell-md-3 d-flex flex-align-center flex-align-center"
                     style="background: #150101;">
                    <div class="row text-center">
                        <h1 class="cell-12" id="convertResult"></h1>
                        <p class="cell-12"  id="convertTerms"></p>
                    </div>

                </div>
                <div class="cell cell-md-6">
                    <form data-role="validator">
                        <div class="form-group">
                            <label>Convert By</label>
                            <select data-role="select" id="findBy" name="findBy">
                                <option value="{{config('currency.localSymbol')}}" data-template="<span
                                    class='mif-amazon icon'></span> $1" selected>
                                    {{config('currency.localSymbol')}}
                                </option>
                                <option value="{{config('currency.foreignSymbol')}}" data-template="<span class='mif-apple icon'></span> $1">
                                    {{config('currency.foreignSymbol')}}
                                </option>

                            </select>
                            <small class="text-muted">From amount Type.</small>
                        </div>
                        <div class="form-group" >
                            <label>Amount</label>

                            <input type="number"  id="rateAmount" name="rateAmount"
                                   data-validate="required"
                                   placeholder="Enter
                                amount"/>
                            <small class="text-muted">Confirm your Convert Type</small>
                        </div>

                        <div class="form-group">
                            <button type="button" id="convertSubmit" class="button success">Check</button>

                        </div>
                    </form>
                </div>
                <div class="cell cell-md-3" style="background: #150101;"></div>
            </div>
        </div>
    </div>
</div>