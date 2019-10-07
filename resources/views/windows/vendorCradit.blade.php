
<div class="p-2"
    data-role="window"
    data-title="Add Debit"
    data-resizable="true"
    data-draggable="true"
    data-width="600"
    data-height="500"
    data-top="60"
     id="creditWin2" 
    >
    <div class="container">
    <!-- content here -->
    <div class="grid">
    	 <div class="row">
        <div class="cell-12">
        	<div class="row">
        		 <div class="stub" style="width: 50px; background: grey;"></div>
    			<div class="cell" style=" background: lightgrey;">
    				List Amran of payments
    			</div>
        	</div>
        	<div class="row mt-4 p-5">
        		<div class="stub" style="width: 200px; background: lightgrey;">
        			add Debit payment
        		</div>
        		<div class="cell-12 p-2">
<form>
    <div class="row p-1" style="border: 1px solid black;">
        <div class="cell-md-3 d-flex flex-justify-end flex-align-center" style="background: lightgrey;">
            amount
        </div>
        <div class="cell-md-9 pt-1">
            <input type="text" placeholder="Last name">
        </div>
          <div class="cell-md-3 d-flex flex-justify-end flex-align-center" style="background: lightgrey;">
            Date
        </div>
        <div class="cell-md-9 pt-1">
            <input data-role="datepicker"  data-min-year="2014" data-max-year="2020">
        </div>
             <div class="cell-md-3 d-flex flex-justify-end flex-align-center" style="background: lightgrey;">
           type
        </div>
        <div class="cell-md-9 pt-1">
            <select name="" id="">
            	<option value="">Prepaid</option>
            	<option value="">Return</option>
            </select>
        </div>
        <div class="cell-md-3 d-flex flex-justify-end flex-align-center" style="background: lightgrey;">
           Description
        </div>
        <div class="cell-md-9 pt-1">
            <input type="text" placeholder="Last name">
        </div>
    </div>
    <div class="row">
    	<div class="cell text-right">
    		<button class="button primary">Add Payment</button>
    	</div>
    </div>
</form>

        		</div>
        	</div>
        </div>
        <div class="cell-12">
        <table class="table subcompact table-border cell-border">
    <thead>
    <tr>
        <th  class="sortable-column sort-asc">#</th>
        <th  class="sortable-column sort-asc">money</th>
        <th class="sortable-column sort-asc">type</th>
        <th  class="sortable-column sort-asc">date</th>
    </tr>
    </thead>
    <tbody>
    @foreach([1,2,3,4,5,6,7,8,9,10] as $list)
    <tr>
    	<td>1</td>
    	<td>2</td>
    	<td>3</td>
    	<td>4</td>
    </tr>
    @endforeach
    </tbody>
</table>


</div>
    </div>
    </div>
</div>
</div>


