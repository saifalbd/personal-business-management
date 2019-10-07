<?php
namespace App\Http\Helper\Profit;

use App\Model\Option;
use App\Model\Vendor;
use App\Model\Rate;

/**
 * 
 */
class ProfitMaker
{
	protected $req;

	function __construct($req)
	{
		$this->req = $req;
	}
protected function curentBankRate(){
	 return Option::getCurrentRate()->rate;
}
protected function vendorRate(){
$vendor = Vendor::find($this->req->vendor)->ExHistory->first();
return  $vendor? $vendor->ex_rate:0;
}

protected function amount(){return $this->req->amount;}



/**
 *customer ke je rate dewa hoice
 * @return [type] int
 */
/*
protected function giveRateCustomer()
{
	$rate =  Rate::where('withCharge','>=',$this->amount())->first();
	if (!$rate) {
		$rate = Rate::where('withCharge','<=',$this->amount())->latest()->first();

	}
	return $rate? $rate->withCharge/$rate->from:0;
}

*/

protected function vendorCost()
{

return $this->amount()/$this->vendorRate();

}

public function customerCost()
{
	if (isset($this->req->customerCost) && $this->req->customerCost) {
	return $this->req->customerCost;
	}else{
	    return (new OrderBill($this->amount()))->getBill();
		//return $this->amount()/$this->giveRateCustomer();
	}
	
}

/**
 * local curency profit retrun korbe like QR
 * @return [type] [int]
 */
protected function getProfitLocal(){ 
return $this->customerCost()-$this->vendorCost();
}
/**
 * Forgen curency profit retrun korbe like BDT
 * @return [type] [int]
 */
protected function getProfitForgen(){
return $this->getProfitLocal()*$this->curentBankRate();
}


public function result()
{
	return round($this->getProfitForgen(),2);
	//return floor($this->getProfitLocal());
}
}